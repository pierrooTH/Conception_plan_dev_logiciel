<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * * * first page from home
     * @Route("/", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('view/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
