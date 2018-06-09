<?php

namespace Souk\BackEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukBackEndBundle:Default:index.html.twig');
    }
}
