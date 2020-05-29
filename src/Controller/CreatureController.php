<?php

namespace App\Controller;

use App\Entity\Creature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/create_creature", name="create_creature")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $creature = new Creature();
        $creature->setName('Goblin');
        $creature->setAttack(1999);
        $creature->setDefense(222);

        // tell Doctrine you want to (eventually) save the Creature (no queries yet)
        $entityManager->persist($creature);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new creature with id '.$creature->getId());
    }
}
