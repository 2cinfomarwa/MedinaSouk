<?php
/**
 * Created by PhpStorm.
 * User: PC DELL
 * Date: 11/06/2018
 * Time: 15:54
 */

namespace Souk\BackEndBundle\Controller;


use Souk\FrontEndBundle\Entity\Typeevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeeventController extends Controller
{
    public function typeevent_backend_ajouttypeAction(Request $request)
    {
        $typeevent = new Typeevent();
        $form = $this->createForm('Souk\FrontEndBundle\Form\TypeeventType', $typeevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeevent);
            $em->flush();

            return $this->redirectToRoute('event_backend_ajouttype', array('id' => $typeevent->getId()));
        }

        return $this->render('typeevent/backend/ajouttype.html.twig', array(
            'event' => $typeevent,
            'form' => $form->createView(),
        ));


    }
    public function typeevent_backend_listetypeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeevent = $em->getRepository('SoukFrontEndBundle:Typeevent')->findAll();

        return $this->render('typeevent/backend/listeevent.html.twig', array(
            'typeevents' => $typeevent));

    }
}