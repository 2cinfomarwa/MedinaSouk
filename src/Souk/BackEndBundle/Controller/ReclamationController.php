<?php
/**
 * Created by PhpStorm.
 * User: HEJER
 * Date: 12/06/2018
 * Time: 23:38
 */

namespace Souk\BackEndBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReclamationController extends Controller
{
    public function reclamation_backend_listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamation = $em->getRepository('SoukFrontEndBundle:Reclamation')->findAll();

        return $this->render('reclamation/backend/index.html.twig', array(
            'reclamation' => $reclamation
        ));
    }



    public function reclamation_backend_supprimerAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository('SoukFrontEndBundle:Reclamation')->find($id);
        $em->remove($reclamation);
        $em->flush();//Confirmer l'action précédente (suppression)
        return $this->redirectToRoute('reclamation_backend_liste');

    }

    public function reclamation_backend_traiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id= $request->get('id');
        $reclamation= $em->getRepository('SoukFrontEndBundle:Reclamation')
            ->find($id);
        $reclamation->setEtat("Traité");
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute('reclamation_backend_liste');

    }


    public function reclamation_backend_chercherAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $reclamation= null;
        if($request->getMethod()=='POST'){
            $e= $request->get('etat');
            $reclamation= $em->getRepository('SoukFrontEndBundle:Reclamation')
                ->findBy(array("etat"=>$e));
            return $this->render('reclamation/backend/recherche.html.twig'
                ,array('reclamation'=>$reclamation));
        }
        return $this->render('reclamation/backend/recherche.html.twig'
            ,array('reclamation'=>$reclamation));
    }


    public function reclamation_backend_chartsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $reclamations = $em->getRepository('SoukFrontEndBundle:Reclamation')->findByUtilisateur($user);

        $years = [];
        foreach ($reclamations as $reclamation) {
            array_push($years, $reclamation->getDateReclamation()->format('Y'));

        }
        $years = array_unique($years);
        sort($years);
        $dataArray = [
            ['Year', 'Reclamation number'],
           ];
        foreach ($years as $year) {
            $counter = 0;
            foreach ($reclamations as $reclamation) {
                if ($year === $reclamation->getDateReclamation()->format('Y')) {
                    $counter++;
                }
            }
            array_push($dataArray, [$year, (int)$counter] );
        }

        $chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $chart->getData()->setArrayToDataTable($dataArray);

        $chart->getOptions()->getChart()
            ->setTitle('Nombre des réclamations par an')
            ->setSubtitle('2014-2018');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#1b9e77', '#d95f02', '#7570b3'])
            ->getVAxis()
            ->setFormat('decimal');

        return $this->render('reclamation/backend/charts.html.twig', array('chart' => $chart));
    }



}