<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreatureController extends AbstractController
{
    /**
     * @Route("/creature", name="creature")
     */
    public function index()
    {
        return $this->render('creature/index.html.twig', [
            'controller_name' => 'CreatureController',
        ]);
    }
}
