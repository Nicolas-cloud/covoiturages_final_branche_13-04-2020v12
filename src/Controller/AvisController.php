<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reservation;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Trajet;
use App\Entity\Avis;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/{_locale}")
 */
class AvisController extends AbstractController
{


       /**
     * Créer un nouvel avis.
     * @IsGranted("ROLE_USER")
     * @Route("/trajet/nouvel-avis", name="avis_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function createAvis(Request $request, EntityManagerInterface $em) : Response {
        $avis = new Avis();

        $avis->setAutheurAvis($this->getUser()); // il faut faire correspondre le createur du trajet à la personne qui veut éditer ou supprimer

        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($avis);
            // $avis->setAvisTrajet($trajet);

            $em->flush();
            return $this->redirectToRoute('membre_mytrajets');
        }
        return $this->render('avis/create.html.twig', array(
            'form' => $form->createView(),
        ));
     }
}

