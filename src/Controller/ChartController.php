<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tache;
use App\Repository\TacheRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $tache = new Tache();
        $repo = $this->getDoctrine()->getRepository(Tache::class);
        $taches = $repo->findAll();

        /*tableau qui retourn la position des tâches A = 1 B = 2 ...*/
        $upperArr = range('A', 'Z');
        $myLetter = 'B';

        $positionLetter = (array_search($myLetter, $upperArr) + 2);

        return $this->render('view/chart.html.twig', [
            'controller_name' => 'ChartController',
            'taches' => $taches,
            'positionL' => $positionLetter,
        ]);
    }

    public function calcul()
    {

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

        return $this->render('view/chart.html.twig', [
            'controller_name' => 'ChartController',
        ]);
    }
}
