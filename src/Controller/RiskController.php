<?php

namespace App\Controller;

use App\Entity\Risk;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class RiskController extends AbstractController
{
    /**
     * * * first page from home
     * @Route("/risk", name="risk")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $risk = new Risk();

        $form = $this->createFormBuilder($risk)
            ->add('typeOfRisk', TextType::class, [
                'attr' =>[
                    'placeholder' => "Type de risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('probability', NumberType::class, [
                'attr' =>[
                    'placeholder' => "Probabilité du risque (en %)",
                    'class' => 'form-control'
                ]
            ])
            ->add('severity', NumberType::class, [
                'attr' =>[
                    'placeholder' => "Sévérité du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('costRiskReduction', TextType::class, [
                'attr' =>[
                    'placeholder' => "Coût de la réduction du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('owner', TextType::class, [
                'attr' =>[
                    'placeholder' => "Propriétaire du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('meansDetection', TextType::class, [
                'attr' =>[
                    'placeholder' => "Moyens de détection du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('correctiveMeasures', TextType::class, [
                'attr' =>[
                    'placeholder' => "Mesures de correction du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' =>[
                    'label' => "Ajouter un risque",
                    'class' => 'btn bg-gradient-dark w-100 my-4 mb-2'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        $repvisu =  "";

        if($form->isSubmitted()){

            if($form->isValid()){

                $manager->persist($risk);
                $manager->flush();
                $repvisu =  "Envoyé";

            }else{
                $repvisu = "Ce risque existe déjà ou les champs sont incorrect !";
            }
        }

        $repo = $this->getDoctrine()->getRepository(Risk::class);
        $risks = $repo->findAll();

        return $this->render('view/risk.html.twig', [
            'controller_name' => 'RiskController',
            'formRisk' => $form->createView(),
            'risks' => $risks,
            'repvisu' => $repvisu,
        ]);
    }

    /**
     * @Route("/{id}", name="tache_delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $manager, Risk $risk): Response
    {
        if ($this->isCsrfTokenValid('delete'.$risk->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($risk);
            $manager->flush();
        }

        return $this->redirectToRoute('risk');

    }
}
