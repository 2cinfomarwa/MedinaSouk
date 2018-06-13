<?php

namespace Souk\BackEndBundle\Controller;


use Souk\FrontEndBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Souk\FrontEndBundle\Form\EventType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\File\File;

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
            if ($event->getImage()) {
                $image = $event->getImage();
                $image = md5(uniqid()) . '.' . $image->guessExtension();

                $event->setImage($image);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_backend_liste', array('id' => $event->getId()));
        }

        return $this->render('event/backend/ajout.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));


    }

    public function event_backend_listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Event = $em->getRepository('SoukFrontEndBundle:Event')->findAll();

        return $this->render('event/backend/liste.html.twig', array(
            'events' => $Event));

    }

    public function event_backend_supprimerAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('SoukFrontEndBundle:Event')->find($id);
        $em->remove($modele);
        $em->flush();//Confirmer l'action précédente (suppression)
        return $this->redirectToRoute('event_backend_liste');
    }


        public function event_backend_modifierAction(Request $request, Event $event)
        {
            //$deleteForm = $this->createDeleteForm($event);
            $editForm = $this->createForm('Souk\FrontEndBundle\Form\EventType', $event);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('event_backend_liste');
            }

            return $this->render('event/backend/modifier.html.twig', array(
                'event' => $event,
                'edit_form' => $editForm->createView()
                //'delete_form' => $deleteForm->createView(),
            ));
        }
        /*
    public function event_backend_modifierAction(Request $request, Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        //Récupération du modèle
        $event = $em->getRepository('SoukFrontEndBundle:Event')->find($event);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('event_backend_ajout');
        }
        return $this->render('event/backend/ajout.html.twig'
            , array(
                "form" => $form->createView()
            ));
    }
        */
}