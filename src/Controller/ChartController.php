<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart")
     */
    public function index(): Response
    {
        return $this->render('view/chart.html.twig', [
            'controller_name' => 'ChartController',
        ]);
    }

    public function calcul(){

        $nomDeLaTache = "";
        $dureeDeLaTache = 0;
        $dureeDeLaTacheParLafin = 0;
        $dateDebutPlusTot = 0;
        $dateDebutPlusTard = 0;
        $margeLibre = 0;
        $margeTotale = 0;
        $dateDebutPlusTotTacheSuivante = 0;

        $margeLibre = $dateDebutPlusTotTacheSuivante - $dateDebutPlusTot - $dureeDeLaTache;
        $margeTotale = $dateDebutPlusTard - $dateDebutPlusTot;

        $dateDebutPlusTot += $dureeDeLaTache;
        $dateDebutPlusTard -= $dureeDeLaTacheParLafin;

        /*
        "Lien pour les calculs : http://tpmattitude.fr/pert.html";
        */

    }
}
