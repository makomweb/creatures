<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Repository\CreatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CreatureController extends AbstractController
{
    private $repository;

    public function __construct(CreatureRepository $repository) 
    {
        $this->repository = $repository;
    }

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
     * @Route("/creature/{id}", name="creature_show")
     */
    public function show($id)
    {
        $creature = $this->repository->findById($id);

        if (!$creature) {
            throw $this->createNotFoundException(
                'No creature found for id '.$id
            );
        }

        return new Response('Check out this creature: '.$creature->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/create_creature", name="create_creature")
     */
    public function createProduct(): Response
    {
        $creature = new Creature();
        $creature->setName('Goblin');
        $creature->setAttack(1999);
        $creature->setDefense(222);

        $this->repository->save($creature);

        return new Response('Saved new creature with id '.$creature->getId());
    }
}
