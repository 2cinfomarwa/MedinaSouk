<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Commande;
use Souk\FrontEndBundle\Entity\DetailsCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiController extends Controller
{
/********************details commandes ***********************///////

    public  function Api_Commande_details_allAction()
    {
        $detailsCmd = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Detailscommande')->findAll();
        //var_dump($commande);die;
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $formatted = $serializer->normalize($detailsCmd);
        // var_dump($formatted);die;
        return new JsonResponse($formatted);
    }



    public  function Api_Commande_details_findAction($id)
    {
        $Cmd = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Commande')->find($id);
        $detailsCmd = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Detailscommande')->findBy(array('idcommande'=>$Cmd));
        $serializer =new  Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($detailsCmd);
        return new JsonResponse($formatted);
    }




    /******************* produit *************************/

    public  function Api_produits_allAction()
    {
        $prod = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Produit')->findAll();
        //var_dump($commande);die;
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $formatted = $serializer->normalize($prod);
        // var_dump($formatted);die;
        return new JsonResponse($formatted);
    }

    public  function Api_Commande_newAction($idutilisateur,$montantHT,$montantTTC)
    {
        $em = $this->getDoctrine()->getManager();
        $cmd = new Commande();
        $utilisateur = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Utilisateur')->find($idutilisateur);
        $cmd->setIdutilisateur($utilisateur);
        $cmd->setMontantHT($montantHT);
        $cmd->setMontantTTC($montantTTC);
      // $datecmd =  new \DateTime('now', (new \DateTimeZone('Africa/Tunis')));
      // die((string)$datecmd->getTimezone());
        $currentdate = new \DateTime('now');

        $cmd->setDatecmd($currentdate->format('Y-m-d'));
        $em->persist($cmd);
        $em->flush();
        $serializer =new  Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cmd);
        return new JsonResponse($formatted);
    }

    public  function Api_Commande_details_newAction($idproduit,$montantHT,$prixunitaire,$quantite)
    {
        $em = $this->getDoctrine()->getManager();
        $detailscmd = new DetailsCommande();
        $cmd = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Commande')->findCmd();
       $detailscmd->setIdcommande($cmd);

        $prod = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Produit')->find($idproduit);

     $detailscmd->setIdproduit($prod);
     $detailscmd->setMontantht($montantHT);
     $detailscmd->setPrixunitaire($prixunitaire);
     $detailscmd->setQuantite($quantite);
     $em->persist($detailscmd);
     $em->flush();
     $serializer =new  Serializer([new ObjectNormalizer()]);
     $formatted = $serializer->normalize($detailscmd);
     return new JsonResponse($formatted);
    }






}
