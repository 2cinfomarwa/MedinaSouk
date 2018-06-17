<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 24/04/2018
 * Time: 18:41
 */

namespace Souk\FrontEndBundle\Controller;
use Souk\FrontEndBundle\Entity\Commande;
use Souk\FrontEndBundle\Entity\DetailsCommande;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;



class PanierController extends Controller
{


    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

      //  $commandes = $em->getRepository('SoukFrontEndBundle:Commande')->findAll();

        return $this->render('panier/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validationAction()
    {
        //if ($this->get('request')->getMethod() == 'POST')
           // $this->setLivraisonOnSession();
        $user = $this->getUser();
        $commande = new Commande();

        $em = $this->getDoctrine()->getManager();

        $commande->setIdutilisateur($user);

        $em->persist($commande);
       $em->flush();
        $session =  new Session();
        $panier = $session->get('panier');
      //  $adresse = $session->get('adresse');
        $totalHT = 0 ;
        $produits = $em->getRepository('SoukFrontEndBundle:Produit')->findArray(array_keys($session->get('panier')));
       // $livraison = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['livraison']);
       // $facturation = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $cmd = $em->getRepository('SoukFrontEndBundle:Commande')->findCmd();
     //   die('idcom '.$cmd->getId());
        foreach($produits as $produit) {
            $idprod = $produit->getId();
            $qte = $panier[$produit->getId()];
            /*echo 'prod'.$idprod.' qte:'.$qte;
            echo 'emai'.$commande->getIdUtilisateur()->getEmail();*/
            $prixUnitaire = $produit->getPrixunitaire();
            $prixHT = $qte *  $prixUnitaire ;

            $totalHT = $totalHT + $prixHT ;
            $detailsCmd = new DetailsCommande();
            $detailsCmd->setIdproduit($produit);
            $detailsCmd->setQuantite($qte);
            $detailsCmd->setIdcommande($cmd);
            $detailsCmd->setPrixunitaire($prixUnitaire);
            $detailsCmd->setMontantht($prixHT);
            $em = $this->getDoctrine()->getManager();
            $em->persist($detailsCmd);

            $em->flush();
        }

        //Ici le mail de validation

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('hassenslimi12@gmail.com')
            ->setTo('hassen.slimi@esprit.tn')
           ->setBody($this->renderView('panier/validationEmail.html.twig'),'text/html');



        $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername("hassenslimi12@gmail.com")
            ->setPassword("Maryouma170717");

$mailer = new Swift_Mailer($transporter);
        $mailer->send($message);


       return $this->render('panier/validation.html.twig', array('produits' => $produits,
            'panier' => $panier,
           'commande'=>$cmd));

    }




    public function supprimer_panierAction($id)
    {
        $session =  new Session();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $this->get('session')->getFlashBag()->add('success', 'Article supprimé avec succès');
        }

        return $this->redirectToRoute('panier');
    }

    public function ajouter_panierAction(Request $request, $id)
    {

        $session =  new Session();


        if (!$session->has('panier'))
        {$session->set('panier', array());}
        $panier = $session->get('panier');
        // $panier[$id] = $request->query->get('qte');//$this->get('session')->get('qte');
        // var_dump($panier);
        //  die();

        if (array_key_exists($id, $panier)) {

            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);



        return $this->redirectToRoute('panier');


        /*   if (array_key_exists($id, $panier)) {

               if ($request->query->get('qte') != null) $panier[$id] = $this->getRequest()->query->get('qte');
               $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
           } else {
               if ($this->getRequest()->query->get('qte') != null)
                   $panier[$id] = $this->getRequest()->query->get('qte');
               else
                   $panier[$id] = 1;

               $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
           }

           $session->set('panier',$panier);


           return $this->redirectToRoute('panier');*/


        /*$session = new Session();
        $session->set('name','hassen slimi');
        $user = $session->get('name');


       return $this->render('commande/ajouter_panier.html.twig',['user'=>$user]);*/


    }
    public function panierAction()
    {
        $session = new Session();

        if (!$session->has('panier'))
        {$session->set('panier', array());}
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('SoukFrontEndBundle:Produit')->findArray(array_keys($session->get('panier')));

        return $this->render('panier/panier.html.twig', array('produits' => $produits,
            'panier' => $session->get('panier')));
    }





}