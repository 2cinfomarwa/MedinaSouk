<?php

namespace Souk\FrontEndBundle\Controller;

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
}
