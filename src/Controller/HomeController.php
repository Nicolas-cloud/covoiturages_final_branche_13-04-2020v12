<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



    /**
     * afficher la page d'accueil
     * 
     * @Route("/accueil", name ="home")
     */
    public function accueil() {

        return $this->render('home/home.html.twig');
    }

}
