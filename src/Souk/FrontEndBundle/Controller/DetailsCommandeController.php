<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\DetailsCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Detailscommande controller.
 *
 */
class DetailsCommandeController extends Controller
{
    /**
     * Lists all detailsCommande entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $detailsCommandes = $em->getRepository('SoukFrontEndBundle:DetailsCommande')->findAll();

        return $this->render('detailscommande/index.html.twig', array(
            'detailsCommandes' => $detailsCommandes,
        ));
    }

    /**
     * Creates a new detailsCommande entity.
     *
     */
    public function newAction(Request $request)
    {
        $detailsCommande = new Detailscommande();
        $form = $this->createForm('Souk\FrontEndBundle\Form\DetailsCommandeType', $detailsCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detailsCommande);
            $em->flush();

            return $this->redirectToRoute('detailscommande_show', array('id' => $detailsCommande->getId()));
        }

        return $this->render('detailscommande/new.html.twig', array(
            'detailsCommande' => $detailsCommande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a detailsCommande entity.
     *
     */
    public function showAction(DetailsCommande $detailsCommande)
    {
        $deleteForm = $this->createDeleteForm($detailsCommande);

        return $this->render('detailscommande/show.html.twig', array(
            'detailsCommande' => $detailsCommande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing detailsCommande entity.
     *
     */
    public function editAction(Request $request, DetailsCommande $detailsCommande)
    {
        $deleteForm = $this->createDeleteForm($detailsCommande);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\DetailsCommandeType', $detailsCommande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detailscommande_edit', array('id' => $detailsCommande->getId()));
        }

        return $this->render('detailscommande/edit.html.twig', array(
            'detailsCommande' => $detailsCommande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a detailsCommande entity.
     *
     */
    public function deleteAction(Request $request, DetailsCommande $detailsCommande)
    {
        $form = $this->createDeleteForm($detailsCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($detailsCommande);
            $em->flush();
        }

        return $this->redirectToRoute('detailscommande_index');
    }

    /**
     * Creates a form to delete a detailsCommande entity.
     *
     * @param DetailsCommande $detailsCommande The detailsCommande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DetailsCommande $detailsCommande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detailscommande_delete', array('id' => $detailsCommande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
