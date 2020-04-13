<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchTrajetType;
use App\Repository\TrajetRepository;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 
 *  @Route("/{_locale}") 
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search.trajet")
     * @param Request $request
     */
    public function searchTrajet(Request $request, TrajetRepository $trajetRepository) : Response
    {
        $trajets=[];
        $SearchTrajetForm = $this->createForm(SearchTrajetType::class);

        if ($SearchTrajetForm->handleRequest($request)->isSubmitted() && $SearchTrajetForm->isValid()) {
            $criteria = $SearchTrajetForm->getData();
            $trajets = $trajetRepository->searchTrajet($criteria);
        }

        return $this->render('search/searchtrajet.html.twig', [
            'form' => $SearchTrajetForm->createView(),
            'trajets' => $trajets,
        ]);
    }


        /**
     * @Route("/search/byDate", name="search.trajet_bydate")
     * @param Request $request
     */
    public function searchTrajetByDate(Request $request, TrajetRepository $trajetRepository) : Response
    {
        $trajets=[];
        $SearchTrajetForm = $this->createForm(SearchTrajetType::class);

        if ($SearchTrajetForm->handleRequest($request)->isSubmitted() && $SearchTrajetForm->isValid()) {
            $criteria = $SearchTrajetForm->getData();
            $trajets = $trajetRepository->searchTrajetByDate($criteria);
        }

        return $this->render('search/searchtrajetbydate.html.twig', [
            'form' => $SearchTrajetForm->createView(),
            'trajets' => $trajets,
        ]);
    }
}
