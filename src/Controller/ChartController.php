<?php


namespace App\Controller;

use App\Entity\Creature;
use App\Form\CreatureType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/chart")
 */
class CreatureController
{
    /**
     * Show a chart
     * 
     * @Route("/show", name="chart_show")
     */
    public function show()
    {
        $data = 'world';
        
        return $this->render('chart/show.html.twig',
            [
                'data' => $data
            ]);
    }
}