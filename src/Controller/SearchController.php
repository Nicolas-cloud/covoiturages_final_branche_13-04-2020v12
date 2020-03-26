<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchTrajetType;
use App\Repository\TrajetRepository;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SearchController extends AbstractController
{
    /**
     * @Route("/search/", name="search.trajet")
     * @param Request $request
     */
    public function searchTrajet(Request $request, TrajetRepository $trajetRepository) : Response
    {
        $trajets=[];
        $SearchTrajetForm = $this->createForm(SearchTrajetType::class);
        
        /*
        $formBuilder = $this->createFormBuilder(SearchTrajetType::class);
        $SearchTrajetForm = $formBuilder->getForm();
        // $SearchTrajetForm->handleRequest($request);
        */
        
        if ($SearchTrajetForm->handleRequest($request)->isSubmitted() && $SearchTrajetForm->isValid()) {
            $criteria = $SearchTrajetForm->getData();
                //  dd($criteria);
            $trajets = $trajetRepository->searchTrajet($criteria);
        }

        return $this->render('search/searchtrajet.html.twig', [
            'form' => $SearchTrajetForm->createView(),
            'trajets' => $trajets,
        ]);
    }
}
