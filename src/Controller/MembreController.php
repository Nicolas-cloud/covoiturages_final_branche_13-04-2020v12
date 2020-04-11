<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\TrajetController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/{_locale}", name="membre_")
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
     * @return RedirectResponse
     */
    public function create(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder) : Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {

            // encoder le password
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // enregistre le membre dans la base de données
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('membre_index');
        }
        return $this->render('membre/createuser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/membre/profil", name="profil")
     * @IsGranted("ROLE_USER")
     */
    public function profil()
    {
        return $this->render('membre/profil.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }
    
        /**
     * @IsGranted("ROLE_USER")
     * @Route("/membre/profil/photo", name="photo")
     */
    public function photo()
    {
        return $this->render('membre/photo.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }


    /**
     * Liste des trajets de l'utilisateur connecté.
     * @IsGranted("ROLE_USER")
     * @Route("membre/profil/mestrajets", name="mytrajets")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    /*
    public function mytravels(Request $request, Trajet $trajet, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EditTrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }

        return $this->render('trajet/userTravels.html.twig', ['form' => $form->createView(),]);
    }*/
}
