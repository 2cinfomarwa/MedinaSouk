<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Typeevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Typeevent controller.
 *
 */
class TypeeventController extends Controller
{
    /**
     * Lists all typeevent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeevents = $em->getRepository('SoukFrontEndBundle:Typeevent')->findAll();

        return $this->render('typeevent/index.html.twig', array(
            'typeevents' => $typeevents,
        ));
    }

    /**
     * Creates a new typeevent entity.
     *
     */
    public function newAction(Request $request)
    {
        $typeevent = new Typeevent();
        $form = $this->createForm('Souk\FrontEndBundle\Form\TypeeventType', $typeevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeevent);
            $em->flush();

            return $this->redirectToRoute('typeevent_show', array('id' => $typeevent->getId()));
        }

        return $this->render('typeevent/new.html.twig', array(
            'typeevent' => $typeevent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeevent entity.
     *
     */
    public function showAction(Typeevent $typeevent)
    {
        $deleteForm = $this->createDeleteForm($typeevent);

        return $this->render('typeevent/show.html.twig', array(
            'typeevent' => $typeevent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeevent entity.
     *
     */
    public function editAction(Request $request, Typeevent $typeevent)
    {
        $deleteForm = $this->createDeleteForm($typeevent);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\TypeeventType', $typeevent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeevent_edit', array('id' => $typeevent->getId()));
        }

        return $this->render('typeevent/edit.html.twig', array(
            'typeevent' => $typeevent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeevent entity.
     *
     */
    public function deleteAction(Request $request, Typeevent $typeevent)
    {
        $form = $this->createDeleteForm($typeevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeevent);
            $em->flush();
        }

        return $this->redirectToRoute('typeevent_index');
    }

    /**
     * Creates a form to delete a typeevent entity.
     *
     * @param Typeevent $typeevent The typeevent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Typeevent $typeevent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeevent_delete', array('id' => $typeevent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
