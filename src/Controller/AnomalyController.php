<?php

namespace App\Controller;

use App\Entity\Anomaly;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AnomalyController extends AbstractController
{
    /**
     * * * first page from home
     * @Route("/anomaly", name="anomaly")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $anomaly = new Anomaly();

        $form = $this->createFormBuilder($anomaly)
            ->add('webPageLocation', TextType::class, [
                'attr' =>[
                    'placeholder' => "Emplacement de la page",
                    'class' => 'form-control'
                ]
            ])
            ->add('state', ChoiceType::class, [
                'choices'  => [
                    'Ouvert' => 'Ouvert',
                    'Corrigé' => 'Corrigé',
                    'Non reproduit' => 'Non reproduit',
                    'Fermé' => 'Fermé',
                ],
                'attr' =>[
                    'placeholder' => "État",
                    'class' => 'form-control'
                ]
            ])
            ->add('scenario', TextareaType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Scénario",
                    'class' => 'form-control'
                ]
            ])
            ->add('date', DateType::class, [
                'format' => 'dd/MM/yyyy', 
                'html5' => FALSE,
                'data' => new \DateTime(),
                'view_timezone' => 'Europe/Paris',
                'model_timezone' => 'Europe/Paris',
                'attr' =>[
                    'class' => 'form-control',
        
                ]
            ])
            ->add('author', TextType::class, [
                'attr' =>[
                    'placeholder' => "Auteur",
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' =>[
                    'label' => "Ajouter une anomalie",
                    'class' => 'btn bg-gradient-dark w-100 my-4 mb-2'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        $repvisu =  "";

        if($form->isSubmitted()){

            if($form->isValid()){

                $manager->persist($anomaly);
                $manager->flush();
                $repvisu =  "Envoyé";
                return $this->redirectToRoute('anomaly');

            }else{
                $repvisu = "Cette anomalie existe déjà ou les champs sont incorrect !";
            }
        }

        $repo = $this->getDoctrine()->getRepository(Anomaly::class);
        $anomalies = $repo->findAll();

        return $this->render('view/anomaly.html.twig', [
            'controller_name' => 'AnomalyController',
            'formAnomaly' => $form->createView(),
            'anomalies' => $anomalies,
            'repvisu' => $repvisu,
        ]);
    }


    /**
     * @Route("/{id}/anomaly_edit", name="anomaly_edit", methods={"GET","POST"})
     * @ParamConverter("anomaly", options={"id" = "id"})
     */
    public function edit(Request $request, Anomaly $anomaly, EntityManagerInterface $manager): Response
    {
        $form = $this->createFormBuilder($anomaly)
            ->add('webPageLocation', TextType::class, [
                'attr' =>[
                    'placeholder' => "Emplacement de la page",
                    'class' => 'form-control'
                ]
            ])
            ->add('state', ChoiceType::class, [
                'choices'  => [
                    'Ouvert' => 'Ouvert',
                    'Corrigé' => 'Corrigé',
                    'Non reproduit' => 'Non reproduit',
                    'Fermé' => 'Fermé',
                ],
                'attr' =>[
                    'placeholder' => "État",
                    'class' => 'form-control'
                ]
            ])
            ->add('scenario', TextareaType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Scénario",
                    'class' => 'form-control'
                ]
            ])
            ->add('date', DateType::class, [
                'format' => 'dd/MM/yyyy', 
                'html5' => FALSE,
                'view_timezone' => 'Europe/Paris',
                'model_timezone' => 'Europe/Paris',
                'attr' =>[
                    'class' => 'form-control',
        
                ]
            ])
            ->add('author', TextType::class, [
                'attr' =>[
                    'placeholder' => "Auteur",
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' =>[
                    'label' => "Ajouter une anomalie",
                    'class' => 'btn bg-gradient-dark w-100 my-4 mb-2'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        $repvisu =  "";

        if($form->isSubmitted()){

            if($form->isValid()){

                $manager->persist($anomaly);
                $manager->flush();
                $repvisu =  "Envoyé";
                return $this->redirectToRoute('anomaly');

            }else{
                $repvisu = "Cette anomalie existe déjà ou les champs sont incorrect !";
            }
        }

        $repo = $this->getDoctrine()->getRepository(Anomaly::class);
        $anomalies = $repo->findAll();

        return $this->render('view/anomaly/edit.html.twig', [
            'controller_name' => 'AnomalyController',
            'formAnomaly' => $form->createView(),
            'anomalies' => $anomalies,
            'repvisu' => $repvisu,
        ]);
    }

    /**
     * @Route("/{id}/anomaly_delete", name="anomaly_delete", methods={"POST"})
     * @ParamConverter("anomaly", options={"id" = "id"})
     */
    public function delete(Request $request, EntityManagerInterface $manager, Anomaly $anomaly): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anomaly->getId(), $request->request->get('_token'))) {
            $manager->remove($anomaly);
            $manager->flush();
        }
        return $this->redirectToRoute('anomaly');

    }
}
