<?php

namespace Souk\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukFrontEndBundle:Default:index.html.twig');
    }

    public function accueilAction()
    {
        return $this->render('SoukFrontEndBundle:Default:accueil.html.twig');
    }
}
