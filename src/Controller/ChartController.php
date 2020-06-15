<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/chart")
 */
class ChartController extends AbstractController
{
    /**
     * Show a chart
     * 
     * @Route("/show", name="chart_show")
     */
    public function showAction()
    {
        $data = 'world';
        
        return $this->render('chart/show.html.twig',
            [
                'data' => $data
            ]);
    }
}