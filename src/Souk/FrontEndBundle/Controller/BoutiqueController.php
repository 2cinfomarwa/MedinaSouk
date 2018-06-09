<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Boutique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Boutique controller.
 *
 */
class BoutiqueController extends Controller
{
    /**
     * Lists all boutique entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $boutiques = $em->getRepository('SoukFrontEndBundle:Boutique')->findAll();

        return $this->render('boutique/index.html.twig', array(
            'boutiques' => $boutiques,
        ));
    }

    /**
     * Creates a new boutique entity.
     *
     */
    public function newAction(Request $request)
    {
        $boutique = new Boutique();
        $form = $this->createForm('Souk\FrontEndBundle\Form\BoutiqueType', $boutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($boutique);
            $em->flush();

            return $this->redirectToRoute('boutique_show', array('id' => $boutique->getId()));
        }

        return $this->render('boutique/new.html.twig', array(
            'boutique' => $boutique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a boutique entity.
     *
     */
    public function showAction(Boutique $boutique)
    {
        $deleteForm = $this->createDeleteForm($boutique);

        return $this->render('boutique/show.html.twig', array(
            'boutique' => $boutique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing boutique entity.
     *
     */
    public function editAction(Request $request, Boutique $boutique)
    {
        $deleteForm = $this->createDeleteForm($boutique);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\BoutiqueType', $boutique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('boutique_edit', array('id' => $boutique->getId()));
        }

        return $this->render('boutique/edit.html.twig', array(
            'boutique' => $boutique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a boutique entity.
     *
     */
    public function deleteAction(Request $request, Boutique $boutique)
    {
        $form = $this->createDeleteForm($boutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($boutique);
            $em->flush();
        }

        return $this->redirectToRoute('boutique_index');
    }

    /**
     * Creates a form to delete a boutique entity.
     *
     * @param Boutique $boutique The boutique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Boutique $boutique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('boutique_delete', array('id' => $boutique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
