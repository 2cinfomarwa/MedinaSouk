<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Categorielieu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorielieu controller.
 *
 */
class CategorielieuController extends Controller
{
    /**
     * Lists all categorielieu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorielieus = $em->getRepository('SoukFrontEndBundle:Categorielieu')->findAll();

        return $this->render('categorielieu/index.html.twig', array(
            'categorielieus' => $categorielieus,
        ));
    }

    /**
     * Creates a new categorielieu entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorielieu = new Categorielieu();
        $form = $this->createForm('Souk\FrontEndBundle\Form\CategorielieuType', $categorielieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorielieu);
            $em->flush();

            return $this->redirectToRoute('categorielieu_show', array('id' => $categorielieu->getId()));
        }

        return $this->render('categorielieu/new.html.twig', array(
            'categorielieu' => $categorielieu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorielieu entity.
     *
     */
    public function showAction(Categorielieu $categorielieu)
    {
        $deleteForm = $this->createDeleteForm($categorielieu);

        return $this->render('categorielieu/show.html.twig', array(
            'categorielieu' => $categorielieu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorielieu entity.
     *
     */
    public function editAction(Request $request, Categorielieu $categorielieu)
    {
        $deleteForm = $this->createDeleteForm($categorielieu);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\CategorielieuType', $categorielieu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorielieu_edit', array('id' => $categorielieu->getId()));
        }

        return $this->render('categorielieu/edit.html.twig', array(
            'categorielieu' => $categorielieu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorielieu entity.
     *
     */
    public function deleteAction(Request $request, Categorielieu $categorielieu)
    {
        $form = $this->createDeleteForm($categorielieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorielieu);
            $em->flush();
        }

        return $this->redirectToRoute('categorielieu_index');
    }

    /**
     * Creates a form to delete a categorielieu entity.
     *
     * @param Categorielieu $categorielieu The categorielieu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorielieu $categorielieu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorielieu_delete', array('id' => $categorielieu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
