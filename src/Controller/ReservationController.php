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
     * @Route("trajet/{slug}/reservation", name="trajet_reservation")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function reservation(Request $request, Reservation $reservation, EntityManagerInterface $em): Response
    {

        $reservation= new Reservation();
        //$reservation->setPassager();

        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $manager->persist($reservation);
            $manager->flush();
            return $this->redirectToRoute('/');
        }           
        return $this->render('reservation/reservation.html.twig', array('formReservation' => $form->createView(),));
    
    }

}

