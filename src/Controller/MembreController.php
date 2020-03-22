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
    
}
