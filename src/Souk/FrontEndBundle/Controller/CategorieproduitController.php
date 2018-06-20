<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Categorieproduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Categorieproduit controller.
 *
 */
class CategorieproduitController extends Controller
{
    /**
     * Lists all categorieproduit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieproduits = $em->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();

        return $this->render('categorieproduit/index.html.twig', array(
            'categorieproduits' => $categorieproduits,
        ));
    }

    public function listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();

        return $this->render('categorieproduit/liste.html.twig', array(
            'categorieproduits' => $produits,
        ));
    }
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieproduits = $em->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();


        return $this->render('categorieproduit/menu.html.twig', array(
            'categories' => $categorieproduits,
        ));
    }


    /**
     * Creates a new categorieproduit entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorieproduit = new Categorieproduit();
        $form = $this->createForm('Souk\FrontEndBundle\Form\CategorieproduitType', $categorieproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieproduit);
            $em->flush();

            return $this->redirectToRoute('categorieproduit_show', array('id' => $categorieproduit->getId()));
        }

        return $this->render('categorieproduit/new.html.twig', array(
            'categorieproduit' => $categorieproduit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieproduit entity.
     *
     */
    public function showAction(Categorieproduit $categorieproduit)
    {
        $deleteForm = $this->createDeleteForm($categorieproduit);

        return $this->render('categorieproduit/show.html.twig', array(
            'categorieproduit' => $categorieproduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieproduit entity.
     *
     */
    public function editAction(Request $request, Categorieproduit $categorieproduit)
    {
        $deleteForm = $this->createDeleteForm($categorieproduit);
        $editForm = $this->createForm('Souk\FrontEndBundle\Form\CategorieproduitType', $categorieproduit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieproduit_edit', array('id' => $categorieproduit->getId()));
        }

        return $this->render('categorieproduit/edit.html.twig', array(
            'categorieproduit' => $categorieproduit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieproduit entity.
     *
     */
    public function deleteAction(Request $request, Categorieproduit $categorieproduit)
    {
        $form = $this->createDeleteForm($categorieproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieproduit);
            $em->flush();
        }

        return $this->redirectToRoute('categorieproduit_index');
    }

    /**
     * Creates a form to delete a categorieproduit entity.
     *
     * @param Categorieproduit $categorieproduit The categorieproduit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorieproduit $categorieproduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorieproduit_delete', array('id' => $categorieproduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  /*********api categorie produit*******/
    public  function Api_Categorie_produit_allAction()
    { //die('ffff');
        $categorie_produit = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();

        //var_dump($commande);die;
        $serializer = new Serializer(array(new ObjectNormalizer()));
        //die('ffff');
        $formatted = $serializer->normalize($categorie_produit);
        // var_dump($formatted);die;
        return new JsonResponse($formatted);
    }

    public  function Api_Categorie_produit_findAction($id)
    {
        $categorie_produit = $this->getDoctrine()->getManager()
            ->getRepository('SoukFrontEndBundle:Categorieproduit')->find($id);
        $serializer =new  Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($categorie_produit);
        return new JsonResponse($formatted);
    }
}
