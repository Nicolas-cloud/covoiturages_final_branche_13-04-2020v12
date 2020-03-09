<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Repository\TrajetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class TrajetController extends AbstractController
{
    /**
     * Lister tous les trajets non expirés.
     * @Route("/trajet/", name="trajet.list")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function list(EntityManagerInterface $em) : Response
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsNonExpires();

        /*
        $stages = $this->getDoctrine()->getRepository(Stage::class)->findAll();        createQuery(
            'SELECT t FROM App:Trajet t WHERE t.date_expiration > :date'
        )->setParameter('date', new \DateTime());
        $trajets = $query->getResult();
        */

        return $this->render('trajet/list.html.twig', [
            'trajets' => $trajets,
        ]);
    }


    /**
     * Chercher et afficher un trajet.
     * @Route("/trajet/{id}", name="trajet.show", requirements={"id" = "\d+"})
     * @param Trajet $trajet
     * @return Response
     */
    public function show(Trajet $trajet) : Response
    {
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
        ]);
    }
}
