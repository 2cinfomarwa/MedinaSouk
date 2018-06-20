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

    public function menu_profilAction()
    {
      /*  $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('SoukFrontEndBundle:Produit')->findAll();*/

        return $this->render('utilisateur/menu_profil.html.twig');
    }

    public function mes_commandesAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur'=>$user));
        $pageCmd  = $this->get('knp_paginator')->paginate(
            $cmd,
            $request->query->get('page', 1), 10 );

        return $this->render('utilisateur/mes_commandes.html.twig',array('utilisateur'=>$user, 'commandes'=>$pageCmd ,'etat' =>'All'));

    }
    public function mes_commandes_filtrerAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        if($request->getMethod()== "POST")
        {

            $etat=$request->get('status');

            if($etat == "All") {
                $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur' => $user));
                $pageCmd  = $this->get('knp_paginator')->paginate(
                    $cmd,
                    $request->query->get('page', 1), 10 );
                return $this->render('utilisateur/mes_commandes.html.twig', array('utilisateur' => $user, 'commandes' => $pageCmd,'etat' => 'All'));
            }else{
                $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur' => $user, 'etat' => $etat));
                $pageCmd  = $this->get('knp_paginator')->paginate(
                    $cmd,
                    $request->query->get('page', 1), 10 );
              // die($pageCmd);
             //  echo  $request->get('page'); //$request->query->get('page', 1);
              // exit;
                return $this->render('utilisateur/mes_commandes.html.twig', array('utilisateur' => $user, 'commandes' => $pageCmd,'etat' => $etat));
            }



        }
        else{

            $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findBy(array('idutilisateur' => $user));
            $pageCmd  = $this->get('knp_paginator')->paginate(
                $cmd,
                $request->query->get('page', 1), 10 );
            return $this->render('utilisateur/mes_commandes.html.twig', array('utilisateur' => $user, 'commandes' => $pageCmd,'etat' =>'All'));

        }
    }
}
