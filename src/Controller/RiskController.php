<?php

namespace App\Controller;

use App\Entity\Risk;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('typeOfRisk', ChoiceType::class, [
                'choices'  => [
                    'Taille du projet' => 'Taille du projet',
                    'Structure de l\'équipe' => 'Structure de l\'équipe',
                    'Calendrier du projet' => 'Calendrier du projet',
                    'Dotation du projet' => 'Dotation du projet',
                    'Rentabilité' => 'Rentabilité',
                    'Sous-traitance' => 'Sous-traitance',
                    'Disponibilité des équipes' => 'Disponibilité des équipes',
                    'Clôture du périmètre fonctionnel' => 'Clôture du périmètre fonctionnel',
                    'Compréhension des processus' => 'Compréhension des processus',
                    'Connaissance du domaine métier' => 'Connaissance du domaine métier',
                    'Conduite du changement' => 'Conduite du changement',
                    'Adhérence' => 'Adhérence',
                    'Plateforme de développement' => 'Plateforme de développement',
                    'Utilisation de composants tiers' => 'Utilisation de composants tiers',
                    'Maîtrise des technologies par l\'équipe' => 'Maîtrise des technologies par l\'équipe',
                    'Respects des contraintes environnementales' => 'Respects des contraintes environnementales',
                    'Type de développement' => 'Type de développement',
                    'Adaptation d’un développement existant' => 'Adaptation d’un développement existant',
                    'Généricité et réutilisation du produit' => 'Généricité et réutilisation du produit',
                    'Coût et charge du projet' => 'Coût et charge du projet',
                ],
                'attr' =>[
                    'placeholder' => "Type de risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('risk', TextType::class, [
                'attr' =>[
                    'placeholder' => "Nom du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('probability', NumberType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Probabilité du risque (en %)",
                    'class' => 'form-control'
                ]
            ])
            ->add('severity', ChoiceType::class, [
                'required' => false,
                'choices'  => [
                    0 => 0,
                    1 => 1,
                    2 => 2,
                    3 => 3
                ],
                'attr' =>[
                    'placeholder' => "Sévérité du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('costRiskReduction', TextType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Coût de la réduction du risque",
                    'class' => 'form-control',
                    ''
                ]
            ])
            ->add('owner', TextType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Propriétaire du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('meansDetection', TextType::class, [
                'required' => false,
                'attr' =>[
                    'placeholder' => "Moyens de détection du risque",
                    'class' => 'form-control'
                ]
            ])
            ->add('correctiveMeasures', TextType::class, [
                'required' => false,
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
     * @Route("/{id}", name="risk_delete", methods={"POST"})
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
