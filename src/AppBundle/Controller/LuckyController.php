<?php

namespace AppBundle\Controller;

use AppBundle\Utils\StudentGrades;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FPDF;

class LuckyController extends Controller
{

    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = rand(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/lucky/number/{count}")
     */
    public function multipleNumberAction($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        return new Response(
            '<html><body>Lucky numbers: ' . $numbersList . '</body></html>'
        );
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new Response(
            json_encode($data),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/api/lucky/number/{count}")
     */
    public function apiMultipleNumberAction($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        };

        return new JsonResponse($numbers);
    }

    /**
     * @Route("/zeugnis/{id}", defaults={"id": 1}, requirements={"id": "\d+"})
     * @param $id
     * @return Response
     */
    public function getZeugnis(int $id)
    {
        $resources = $this->get('kernel')->locateResource('@AppBundle/Resources/');


        $grades = new StudentGrades($this->getDoctrine(), $resources, $id);
        $pdf = $grades->generateZeugnis();
        $output = $pdf->Output("I");
        return new Response(
            $output,
            200,
            array('Content-Type' => 'application/pdf')
        );
    }

    /**
     * @Route("/transcript/{id}", defaults={"id": 1}, requirements={"id": "\d+"})
     * @param $id
     * @return Response
     */
    public function getTranscript(int $id)
    {
        $resources = $this->get('kernel')->locateResource('@AppBundle/Resources/');


        $grades = new StudentGrades($this->getDoctrine(), $resources, $id);
        $pdf = $grades->generateTranscript();
        $output = $pdf->Output("I");
        return new Response(
            $output,
            200,
            array('Content-Type' => 'application/pdf')
        );
    }

}