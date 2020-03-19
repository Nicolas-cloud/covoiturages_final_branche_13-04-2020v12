<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\TrajetController;


class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="membre.index")
     */
    public function index()
    {
        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }
    
}
