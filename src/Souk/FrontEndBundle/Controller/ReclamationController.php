<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Reclamation;
use Souk\FrontEndBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reclamation controller.
 *
 */
class ReclamationController extends Controller
{

    public function newAction(Request $request)
    {
        $reclamation = new Reclamation();
        $user = $this->getUser();
        $form = $this->createForm(
            ReclamationType::class, $reclamation,
            array('user' => $this->getUser())
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($reclamation->getFile()) {
                $file = $reclamation->getFile();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('uploads_directory_reclamation'),
                    $fileName
                );
                $reclamation->setFile($fileName);
            }
            $reclamation->setUtilisateur($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            //Sending email to customer
            $message = (new \Swift_Message('Souk-El-Mdina : Reclamation'))
                ->setFrom('noreply@souklemdina.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'SoukFrontEndBundle:Reclamation:email.html.twig',
                        array('data' => $reclamation)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('reclamation_detail', ['id' => $reclamation->getId()]);
        }

        return $this->render('@SoukFrontEnd/Reclamation/principal.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reclamation entity.
     *
     */
    public function showAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('reclamation/show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     */
    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('id' => $reclamation->getId()));
        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function updateAction (Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        //Récupération du modèle
        $Reclamation = $em->getRepository('SoukFrontEndBundle:Reclamation')->find($id);
        $form = $this->createForm(ReclamationType::class,$Reclamation);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('reclamation_detail', ['id' => $Reclamation->getId()]);
        }
        return $this->render('SoukFrontEndBundle:Reclamation:update.html.twig'
            ,array(
                "form"=>$form->createView()
            ));
    }

    /**
     * Deletes a reclamation entity.
     *
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $reclamation= $em->getRepository('SoukFrontEndBundle:Reclamation')->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('reclamation_new');

    }

    //param converter
    public function detailAction(Reclamation $reclamation){

        return $this->render('SoukFrontEndBundle:Reclamation:list.html.twig'
            ,[
                "reclamation"=>$reclamation
            ]);
    }


    public function principalAction()
    {
        return $this->render("SoukFrontEndBundle:Reclamation:principal.html.twig", array());
    }


    public function conditionsAction()
    {
        return $this->render("SoukFrontEndBundle:Reclamation:Conditionsgenerale.html.twig", array());
    }

    public function quitterAction()
    {
        return $this->redirectToRoute('souk_front_end_elmadina_accueil');
    }


    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}
