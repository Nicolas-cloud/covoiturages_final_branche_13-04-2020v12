<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\TrajetController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;


/**
 * @Route("/", name="membre_")
 **/
class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="index")
     */
    public function index()
    {
        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }

    /**
     * Créer un nouveau utilisateur.
     * @Route("/nouveau-membre", name="create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($trajet);
             $em->flush();
            return $this->redirectToRoute('membre_index');
        }
        return $this->render('trajet/usercreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
