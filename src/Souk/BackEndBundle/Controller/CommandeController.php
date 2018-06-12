<?php

namespace Souk\BackEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Commande controller.
 *
 */
class CommandeController extends Controller
{

/***************** partie BAckend ************************/
    public function commande_backend_listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('SoukFrontEndBundle:Commande')->findAll();

        return $this->render('commande/backend/index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    public function commande_backend_detailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cmd_header = $em->getRepository('SoukFrontEndBundle:Commande')->find($id);
        $cmd_postes = $em->getRepository('SoukFrontEndBundle:Detailscommande')->findby(array('idcommande'=>$id));

        return $this->render('commande/backend/details.html.twig', array(
            'header' => $cmd_header,
            'postes' => $cmd_postes
        ));
    }

    public function commande_backend_valideAction()
    {
        $em = $this->getDoctrine()->getManager();

        $factures = $em->getRepository('SoukFrontEndBundle:Facture')->findAll();

        return $this->render('commande/backend/valide.html.twig', array(
            'factures' => $factures
        ));
    }

    public function commande_backend_en_attenteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('SoukFrontEndBundle:Commande')->CmdEnAttente();

        return $this->render('commande/backend/en_attente.html.twig', array(
            'commandes' => $commandes
        ));
    }


}
