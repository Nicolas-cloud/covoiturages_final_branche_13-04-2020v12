<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\TrajetController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Reservation;
use App\Form\UserType;
use App\Entity\Trajet;
use App\Repository\TrajetRepository;
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
    
    public function mytravels(): Response
    {
        $user = $this->getUser();
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->findBy(['Autheur' => $user]);
        return $this->render('membre/userTravels.html.twig', [
            'trajets' => $trajets,
        ]);   
    }

        /**
     * Liste des trajets de l'utilisateur connecté.
     * @IsGranted("ROLE_USER")
     * @Route("membre/profil/mesreservations", name="myreservations")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function myreservations(): Response
    {
        $user = $this->getUser();
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findBy(['Passager' => $user]);
        return $this->render('membre/userReservations.html.twig', [
            'reservations' => $reservations,
        ]);   
    }
}
