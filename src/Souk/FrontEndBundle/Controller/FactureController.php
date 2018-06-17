<?php

namespace Souk\FrontEndBundle\Controller;

use http\Env\Response;
use Souk\FrontEndBundle\Entity\Commande;
use Souk\FrontEndBundle\Entity\Facture;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Facture controller.
 *
 */
class FactureController extends Controller
{
    /**
     * Lists all facture entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $factures = $em->getRepository('SoukFrontEndBundle:Facture')->findAll();

        return $this->render('facture/index.html.twig', array(
            'factures' => $factures,
        ));
    }

    /**
     * Creates a new facture entity.
     *
     */
    public function newAction(Request $request)
    {
        $facture = new Facture();
        $form = $this->createForm('Souk\FrontEndBundle\Form\FactureType', $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($facture);
            $em->flush();

            return $this->redirectToRoute('facture_show', array('id' => $facture->getId()));
        }



        return $this->render('facture/new.html.twig', array(
            'facture' => $facture,
            'form' => $form->createView(),
        ));
    }


    public function facturationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->find($id);

        $detailscmd = $em->getRepository('SoukFrontEndBundle:Detailscommande')->findby(array('idcommande'=>$id));

        $facture = new Facture();
        $facture->setIdcommande($cmd);


        $em->persist($facture);
        //$cmd = new Commande();
        $cmd->setEtat("Facturée");
        $em->persist($cmd);
        $em->flush();

        return $this->render('facture/consultation.html.twig', array('details_commande'=>$detailscmd, 'commande'=>$cmd));
    }


    public function facture_PDFAction($id)
    {


        $em = $this->getDoctrine()->getManager();

        $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->find($id);

        $detailscmd = $em->getRepository('SoukFrontEndBundle:Detailscommande')->findby(array('idcommande'=>$id));
        //$cmd = new Commande();
        $cmd->setEtat("Imprimée");
        $em->persist($cmd);
        $em->flush();
       // die("good");
        $html = $this->renderView('facture/facturePDF.html.twig', array('details_commande'=>$detailscmd, 'commande'=>$cmd));

        $html2pdf = new Html2Pdf('P','A4','fr',true, 'UTF-8');
        //echo 'good';
       // exit;
        //echo''die($html);
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Facture ');//.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture machmoum');
        $html2pdf->pdf->SetKeywords('facture,machmoum');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('Facture.pdf');

        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;


    }





  // return $this->redirectToRoute('facture_index');


    /**
     * Finds and displays a facture entity.
     *
     */
    public function showAction(Facture $facture)
    {
        $deleteForm = $this->createDeleteForm($facture);

        return $this->render('facture/show.html.twig', array(
            'facture' => $facture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing facture entity.
     *
     */
    public function editAction(Request $request, Facture $facture)
    {
        $deleteForm = $this->createDeleteForm($facture);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\FactureType', $facture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facture_edit', array('id' => $facture->getId()));
        }

        return $this->render('facture/edit.html.twig', array(
            'facture' => $facture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a facture entity.
     *
     */
    public function deleteAction(Request $request, Facture $facture)
    {
        $form = $this->createDeleteForm($facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($facture);
            $em->flush();
        }

        return $this->redirectToRoute('facture_index');
    }

    /**
     * Creates a form to delete a facture entity.
     *
     * @param Facture $facture The facture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Facture $facture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facture_delete', array('id' => $facture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
