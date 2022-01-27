<?php

namespace App\Controller;

use App\Entity\PreviousTask;
use App\Entity\Tache;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    /**
     * * * first page from home
     * @Route("/", name="dashboard")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $tache = new Tache();
            
        $form = $this->createFormBuilder($tache)
                     ->add('letter', TextType::class, [
                         'attr' =>[
                             'placeholder' => "Tâche",
                             'class' => 'form-control'
                         ]
                     ])
                     ->add('duration', NumberType::class, [
                        'attr' =>[
                            'placeholder' => "Durée",
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('description', TextareaType::class, [
                        'attr' =>[
                            'placeholder' => "Description",
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('level', NumberType::class, [
                        'attr' =>[
                            'placeholder' => "Level",
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('submit', SubmitType::class, [
                        'attr' =>[
                            'label' => "Ajouter une tâche",
                            'class' => 'btn bg-gradient-dark w-100 my-4 mb-2'
                        ]
                    ])
                     ->getForm();
                
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
            $manager->persist($tache);
            $manager->flush();

         }



        return $this->render('view/index.html.twig', [
            'controller_name' => 'DashboardController',
            'formTache' => $form->createView(),
        ]);
    }
}
