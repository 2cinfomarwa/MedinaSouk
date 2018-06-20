<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Reclamation;
use Souk\FrontEndBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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




    public function APIaffichereclamationAction ($id){
         $liste = $this->getDoctrine()->getManager()->
         getRepository('SoukFrontEndBundle:Reclamation')->find($id);
         $serializer= new Serializer([new ObjectNormalizer()]);
         $formatted= $serializer->normalize($liste);
         return new JsonResponse($formatted);

     }

    public function APIajoutreclamationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $add = new Reclamation();
        $add->setEtat($request ->get('etat'));
        $add->setSujet($request->get('sujet'));
        $add->setDescription($request->get('description'));
        $add->setDateReclamation($request ->get('date reclamation'));
        $add->setDateProbleme($request->get('date probleme'));
        $em->persist($add);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer ->normalize($add);
        return new JsonResponse($formatted);
    }

}
