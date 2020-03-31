<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**@Route("/{_locale}") */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('home/home.html.twig');

    }

    /**
     * afficher la page d'accueil
     * 
     * @Route("{_locale}/accueil", name ="home")
     */
    public function accueil() {

        return $this->render('home/home.html.twig');
    }

}
