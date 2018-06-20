<?php

namespace Souk\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{


    public function accueilAction()
{

    $em= $this->getDoctrine()->getManager();

    $boutiques = $em->getRepository('SoukFrontEndBundle:Boutique')->findAll();
    $produits = $em->getRepository('SoukFrontEndBundle:Produit')->findAll();
    $promotions = $em->getRepository('SoukFrontEndBundle:Promotion')->findAll();
    $categorieproduits = $em->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();
    $detailsCommandes = $em->getRepository('SoukFrontEndBundle:DetailsCommande')->findAll();
    //(array('quantite' => 'ASC'), 10, 0);
    return $this->render('SoukFrontEndBundle:Default:accueil.html.twig', array(
        'boutiques' => $boutiques,
        'produits' => $produits,
        'promotions' => $promotions,
        'categorieproduits' => $categorieproduits,
        'detailsCommandes' => $detailsCommandes,
    ));

}
    public function registerAction()
    {


        return $this->render('SoukFrontEndBundle:Registration:register.html.twig'

        );

    }

}
