<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends Controller
{


    public function profilAction()
    {

        return $this->render('utilisateur/profil.html.twig');
    }



    public function APIauthentificationAction($id){
        $authentification = $this->getDoctrine()->getManager()->
        getRepository('SoukFrontEndBundle:Utilisateur')->find($id);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formated= $serializer->normalize($authentification);
        return new JsonResponse($formated);
    }

    public function APIinscriptionAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $inscription = new Utilisateur();
        $inscription->setUsername($request ->get('username'));
        $inscription->setPassword($request->get('password'));
        $inscription->setEmail($request->get('email'));
        $em->persist($inscription);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer ->normalize($inscription);
        return new JsonResponse($formatted);
    }


}
