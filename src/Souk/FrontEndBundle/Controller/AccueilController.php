<?php

namespace Souk\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{


    public function accueilAction()
    {
        return $this->render('SoukFrontEndBundle:Default:accueil.html.twig');
    }
}
