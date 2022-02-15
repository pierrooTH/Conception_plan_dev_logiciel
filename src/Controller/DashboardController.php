<?php

namespace App\Controller;

use App\Entity\PreviousTask;
use App\Entity\Tache;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DashboardController extends AbstractController
{
    /**
     * * * first page from home
     * @Route("/", name="dashboard")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $tache = new Tache();
        $previousTask = new PreviousTask();
            
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
                    ->add('previousLetter', TextType::class, [
                        'attr' =>[
                            'placeholder' => "Tâche précédente",
                            'class' => 'form-control'
                        ]
                     ])
                     ->getForm();
                
         $form->handleRequest($request);

        //  $formPreviousTask = $this->createFormBuilder($previousTask)
        //              ->add('letter', EntityType::class, [
        //                 'class' => Tache::class,
        //                 'choice_label' => function(Tache $tache) {
        //                 return "{$tache->getLetter()}";
        //                 },
        //                 'multiple' => false,
        //              ])
                     
        //              ->getForm();
                
        //  $formPreviousTask->handleRequest($request);
        
         $repvisu =  "";

         if($form->isSubmitted()){

            if($form->isValid()){

                $manager->persist($tache);
                $manager->flush();
                $repvisu =  "Envoyé";

            }else{
                $repvisu = "Cette tâche existe déjà ou les champs sont incorrect !";
            }
            
         }

         $repo = $this->getDoctrine()->getRepository(Tache::class);
         $taches = $repo->findAll();



        return $this->render('view/index.html.twig', [
            'controller_name' => 'DashboardController',
            'formTache' => $form->createView(),
            'taches' => $taches,
            'repvisu' => $repvisu, 
        ]);
    }

    /**
     * @Route("/{id}", name="tache_delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $manager, Tache $tache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($tache);
            $manager->flush();
        }

        return $this->redirectToRoute('dashboard');

    }
}
