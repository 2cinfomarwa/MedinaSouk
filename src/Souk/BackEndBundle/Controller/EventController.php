<?php

namespace Souk\BackEndBundle\Controller;


use Souk\FrontEndBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Commande controller.
 *
 */
class EventController extends Controller
{

/***************** partie BAckend ************************/
    public function event_backend_ajoutAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('Souk\FrontEndBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/backend/ajout.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));


    }
    public function event_backend_listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Event= $em->getRepository('SoukFrontEndBundle:Event')->findAll();

        return $this->render('event/backend/liste.html.twig', array(
            'events' => $Event     ));

    }


}
