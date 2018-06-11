<?php

namespace Souk\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller
{


    public function profilAction()
    {

        return $this->render('utilisateur/profil.html.twig');
    }
}
