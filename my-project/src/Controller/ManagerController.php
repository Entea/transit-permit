<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\ApplicationCar;
use App\Form\Type\AcceptFormType;
use App\Form\Type\ApplicationType;
use App\Form\Type\SearchType;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Endroid\QrCode\QrCode;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ManagerController extends AbstractController
{
    /**
     * @var ApplicationRepository
     */
    private $repository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * ManagerController constructor.
     * @param ApplicationRepository $repository
     * @param PaginatorInterface $paginator
     * @param Swift_Mailer $mailer
     */
    public function __construct(ApplicationRepository $repository, PaginatorInterface $paginator, Swift_Mailer $mailer)
    {
        $this->repository = $repository;
        $this->paginator = $paginator;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/manager", name="manager_home")
     */
    public function home()
    {
        return $this->redirectToRoute('manager_index');
    }

    /**
     * @Route("/manager/applications", name="manager_index")
     */
    public function index(Request $request)
    {
        $query = $this->repository->createQueryBuilder('a')
            ->leftJoin(ApplicationCar::class, 'c', 'with', 'c.application = a');

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $data = ($form->isSubmitted()) ? $form->getData() : [];

        // Filter by STATUS_IN_QUEUED by default
        if (!isset($data['status'])) {
            $data['status'] = Application::STATUS_IN_QUEUED;
        }
        $this->applyFilters($data, $query);

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );


        return $this->render('manager/index.html.twig', ['pagination' => $pagination, 'form' => $form->createView(),]);
    }

    /**
     * @Route("/manager/application/{id}", name="manager_view")
     */
    public function view(int $id, Request $request)
    {
        $application = $this->repository->find($id);
        if ($application === null) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(AcceptFormType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Application $application */
            $application = $form->getData();
            $application->setReviewedBy($this->getUser()->getUsername());
            $application->setReviewedAt(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();

            $this->sendEmail($application);

            $this->addFlash(
                'notice',
                'Статус заявки был изменен'
            );
        }

        return $this->render('manager/view.html.twig', ['application' => $application, 'form' => $form->createView(),]);
    }

    private function sendEmail(Application $application)
    {
        $url = $this->generateUrl(
            'application_view',
            array('uid' => $application->getUid()),
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $qrCode = new QrCode($url);

        $html = $this->renderView('emails/result.html.twig', ['application' => $application, 'qrData' => $qrCode->writeDataUri(), 'url' => $url]);

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo($application->getEmail())
            ->setBody(
                $html,
                'text/html'
            )
        ;
        $this->mailer->send($message);
    }

    /**
     * @param array $data
     * @param QueryBuilder $query
     */
    public function applyFilters(array $data, QueryBuilder $query): void
    {
        if (isset($data['status']) && $data['status'] != -1) {
            $query
                ->andWhere('a.status = :status')
                ->setParameter('status', $data['status']);
        }
        if (isset($data['directorFullName'])) {
            $query
                ->andWhere('a.directorFullName like :directorFullName')
                ->setParameter('directorFullName', '%' . $data['directorFullName'] . '%');
        }
        if (isset($data['companyIin'])) {
            $query
                ->andWhere('a.companyIin like :companyIin')
                ->setParameter('companyIin', '%' . $data['companyIin'] . '%');
        }
        if (isset($data['companyName'])) {
            $query
                ->andWhere('a.companyName like :companyName')
                ->setParameter('companyName', '%' . $data['companyName'] . '%');
        }
        if (isset($data['driverFullName'])) {
            $query
                ->andWhere('c.driverFullName like :driverFullName')
                ->setParameter('driverFullName', '%' . $data['driverFullName'] . '%');
        }
        if (isset($data['carIdentifier'])) {
            $query
                ->andWhere('c.carIdentifier like :carIdentifier')
                ->setParameter('carIdentifier', '%' . $data['carIdentifier'] . '%');
        }
    }

}