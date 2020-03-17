<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\User;
use App\Repository\TrajetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TrajetType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
  * Require ROLE_USER for *every* controller method in this class.
  *
  * @IsGranted("ROLE_USER")  
 **/
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
     * @Route("/trajet/{slug}", name="trajet.show",  requirements={"name"=".+"})
     * @param Trajet $trajet
     * @return Response
     */
    public function show(Trajet $trajet) : Response
    {
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
        ]);
    }

    /**
     * Créer un nouveau trajet.
     * @Route("/nouveau-trajet", name="trajet.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response {
        $trajet = new Trajet();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($trajet);
            $em->ﬂush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('trajet/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Éditer un trajet.
     * @Route("trajet/{slug}/edit", name="trajet.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Trajet $trajet, EntityManagerInterface $em) : Response {
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->ﬂush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('trajet/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un trajet.
     * @Route("trajet/{slug}/delete", name="trajet.delete")
     * @param Request $request
     * @param Stage $trajet
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Trajet $trajet, EntityManagerInterface $em) : Response {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('trajet.delete', ['slug' => $trajet->getSlug()]))
            ->getForm();
        $form->handleRequest($request);
    if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('trajet/delete.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
        ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($stage);
        $em->ﬂush();
        return $this->redirectToRoute('trajet.list');
    }
}
