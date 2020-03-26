<?php

namespace App\Controller;

use App\Entity\Application;
use App\Form\Type\ApplicationType;
use App\Form\Type\FindByUidType;
use App\Repository\ApplicationRepository;
use Endroid\QrCode\QrCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ApplicationController extends AbstractController
{
    /**
     * @var ApplicationRepository
     */
    private $repository;

    /**
     * ApplicationController constructor.
     * @param ApplicationRepository $repository
     */
    public function __construct(ApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/application/create", name="application_create")
     */
    public function create(Request $request)
    {
        $application = new Application();

        $form = $this->createForm(ApplicationType::class, $application);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Application $application */
            $application = $form->getData();
            $application->setCreatedAt(new \DateTime());
            $application->setUid(uniqid());

            foreach ($application->getCars() as $car) {
                $car->setApplication($application);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();

            return $this->redirectToRoute('application_success');
        }

        return $this->render('application/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/application/view", name="application_from_home", methods={"POST"})
     */
    public function viewFromHome(Request $request)
    {
        $form = $this->createForm(FindByUidType::class);
        $form->handleRequest($request);

        $application = null;
        if ($form->isSubmitted()) {
            $application = $this->repository->findOneBy(['uid' => $form->getData()['uid']]);
        }
        if ($application === null) {
            return $this->render('application/not_found.html.twig');
        }
        return $this->render('application/view.html.twig', [
            'application' => $application,
        ]);
    }

    /**
     * @Route("/application/success", name="application_success")
     */
    public function success(Request $request)
    {
        return $this->render('application/success.html.twig');
    }

    /**
     * @Route("/application/{uid}/view", name="application_view")
     */
    public function view(string $uid)
    {
        $application = $this->repository->findOneBy(['uid' => $uid]);
        if ($application === null) {
            return $this->render('application_not_found.html.twig');
        }

        $url = $this->generateUrl(
            'application_view',
            array('uid' => $application->getUid()),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return $this->render('application/view.html.twig', [
            'application' => $application,
            'url' => $url
        ]);
    }

//    /**
//     * @Route("/application/{uid}/qr", name="application_qr")
//     */
//    public function qr(string $uid)
//    {
//        $application = $this->repository->findOneBy(['uid' => $uid]);
//        if ($application === null) {
//            throw $this->createNotFoundException();
//        }
//
//        $url = $this->generateUrl(
//            'application_view',
//            array('uid' => $application->getUid()),
//            UrlGeneratorInterface::ABSOLUTE_URL
//        );
//        $qrCode = new QrCode($url);
//
//        return new Response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
//    }

}