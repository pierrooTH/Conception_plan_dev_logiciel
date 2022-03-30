<?php

namespace App\Controller;

use App\Entity\Anomaly;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

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
                'attr' =>[
                    'placeholder' => "Scénario",
                    'class' => 'form-control'
                ]
            ])
            ->add('date', DateTimeType::class, [
                'attr' =>[
                    'placeholder' => "Propriétaire du risque",
                    'class' => 'form-control'
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
     * @Route("/{id}", name="anomaly_delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $manager, Anomaly $anomaly): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anomaly->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($anomaly);
            $manager->flush();
        }

        return $this->redirectToRoute('anomaly');

    }
}
