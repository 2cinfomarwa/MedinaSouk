<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Lieu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lieu controller.
 *
 */
class LieuController extends Controller
{
    /**
     * Lists all lieu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lieus = $em->getRepository('SoukFrontEndBundle:Lieu')->findAll();
        $categorielieus = $em->getRepository('SoukFrontEndBundle:Categorielieu')->findAll();


        return $this->render('lieu/index.html.twig', array(
            'lieus' => $lieus,
            'categorielieus' => $categorielieus,
        ));
    }

    /**
     * Creates a new lieu entity.
     *
     */
    public function newAction(Request $request)
    {
        $lieu = new Lieu();
        $form = $this->createForm('Souk\FrontEndBundle\Form\LieuType', $lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lieu);
            $em->flush();

            return $this->redirectToRoute('lieu_show', array('id' => $lieu->getId()));
        }

        return $this->render('lieu/new.html.twig', array(
            'lieu' => $lieu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lieu entity.
     *
     */
    public function showAction(Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);

        return $this->render('lieu/show.html.twig', array(
            'lieu' => $lieu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lieu entity.
     *
     */
    public function editAction(Request $request, Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\LieuType', $lieu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lieu_edit', array('id' => $lieu->getId()));
        }

        return $this->render('lieu/edit.html.twig', array(
            'lieu' => $lieu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lieu entity.
     *
     */
    public function deleteAction(Request $request, Lieu $lieu)
    {
        $form = $this->createDeleteForm($lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lieu);
            $em->flush();
        }

        return $this->redirectToRoute('lieu_index');
    }

    /**
     * Creates a form to delete a lieu entity.
     *
     * @param Lieu $lieu The lieu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lieu $lieu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lieu_delete', array('id' => $lieu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
