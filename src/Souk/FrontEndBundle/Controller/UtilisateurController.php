<?php

namespace Souk\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends Controller
{


    public function profilAction()
    {

        return $this->render('utilisateur/profil.html.twig');
    }

    public function mes_commandesAction()
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur'=>$user));
        return $this->render('utilisateur/mes_commandes.html.twig',array('utilisateur'=>$user, 'commandes'=>$cmd));
    }
    public function mes_commandes_filtrerAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        if($request->getMethod()== "POST")
        {

            $etat=$request->get('status');
            $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur' => $user, 'etat' => $etat));
            return $this->render('utilisateur/mes_commandes.html.twig', array('utilisateur' => $user, 'commandes' => $cmd));

        }
        else{

            $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur' => $user));
            return $this->render('utilisateur/mes_commandes.html.twig', array('utilisateur' => $user, 'commandes' => $cmd));



        }
    }
}
