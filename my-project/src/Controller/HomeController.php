<?php

namespace App\Controller;

use App\Form\Type\FindByUidType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function create()
    {
        $form = $this->createForm(FindByUidType::class);

        return $this->render('index.html.twig', ['form' => $form->createView()]);
    }
}