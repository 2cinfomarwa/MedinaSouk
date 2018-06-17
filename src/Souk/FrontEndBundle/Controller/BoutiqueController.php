<?php

namespace Souk\FrontEndBundle\Controller;

use Souk\FrontEndBundle\Entity\Boutique;
use Souk\FrontEndBundle\Entity\Utilisateur;
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
        $em= $this->getDoctrine()->getManager();
        $boutiques = $em->getRepository('SoukFrontEndBundle:Boutique')->findAll();
        $produits = $em->getRepository('SoukFrontEndBundle:Produit')->findAll();
        $promotions = $em->getRepository('SoukFrontEndBundle:Promotion')->findAll();
        $categorieproduits = $em->getRepository('SoukFrontEndBundle:Categorieproduit')->findAll();
        //$detailsCommandes = $em->getRepository('SoukFrontEndBundle:DetailsCommande')->findAll();
        //(array('quantite' => 'ASC'), 10, 0);


        return $this->render('boutique/index.html.twig', array(
            'boutiques' => $boutiques,
            'produits' => $produits,
            'promotions' => $promotions,
            'categorieproduits' => $categorieproduits,
            //'detailsCommandes' => $detailsCommandes,
        ));
    }

    /**
     * Creates a new boutique entity.
     *
     */

    public function newAction(Request $request)
    {
        $user = $this->getUser();
        //var_dump($user);die;
        //$user = new Utilisateur();
        if ($request->getMethod() == 'POST')
            //echo $user = $this->container->get('security.context')->getToken()->getUser();
            //$user = new User();

        {    //$userID = $user->getUser()->getId();
            echo 'suite au clic sur le bouton submit';
            $name = $request->get('name');
            $description = $request->get('description');
            $adresse = $request->get('adresse');

            $etat = $request->get('etat');


            $boutique = new Boutique();
            $boutique->setNom($name);
            $boutique->setAdresse($adresse);
            $boutique->setDescription($description);
            $boutique->setIdutilisateur($user);
            $boutique->setEtat($etat);
            $em = $this->getDoctrine()->getManager();
            //persistance d'unn objet ds la base
            $em->persist($boutique);
            //commit
            $em->flush();
            return $this->redirectToRoute('boutique_index');

        }
        return $this->render('boutique/new.html.twig');
    }




    /** public function newAction(Request $request)
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
    }*/

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
