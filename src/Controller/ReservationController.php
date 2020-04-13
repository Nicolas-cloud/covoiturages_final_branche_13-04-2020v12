<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Trajet;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/{_locale}")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /** 
     * Reserver un trajet.
     * @IsGranted("ROLE_USER")
     * @Route("/trajet/{slug}/reservation", name="trajet_reservation")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function reservation(Request $request, Trajet $trajet, EntityManagerInterface $em,  TranslatorInterface $translator): Response
    {
        $reservation= new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($reservation);
            $reservation->setPassager($trajet);
            $place_dispo = $trajet->getNbPlaces();
            $place_reserv = $reservation->getNbPlaces();
            if($place_dispo - $place_reserv < 0 ){
                $error = "Vous ne pouvez pas réserver plus de places qu'il n'y a de places diponibles";
                return $this->render('reservation/create.html.twig', array(
                    'form' => $form->createView(),
                    'reservation'=> $reservation,
                    'trajet' => $trajet,
                    'error' => $error,
                ));

            }
            $error=" ";
            $trajet->setNbPlaces($place_dispo - $place_reserv);
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }    
        $error=" ";
        return $this->render('reservation/create.html.twig', array(
            'form' => $form->createView(),
            'reservation'=> $reservation,
            'trajet' => $trajet,
            'error' => $error,
        ));
    
    }

}

