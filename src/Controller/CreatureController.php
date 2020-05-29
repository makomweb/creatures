<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Repository\CreatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/creature")
 */
class CreatureController extends AbstractController
{
    private $repository;

    public function __construct(CreatureRepository $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * List all creatures.
     * 
     * @Route("/", name="creature_index")
     */
    public function indexAction()
    {
        $creatures = $this->repository->findAll();
        
        return $this->render('creature/index.html.twig',
            [
                'entities' => $creatures
            ]);
    }

    /**
     * Show a single creature entity.
     * 
     * @Route("/{id}", name="creature_show")
     */
    public function showAction($id)
    {
        $creature = $this->repository->findById($id);

        if (!$creature) {
            throw $this->createNotFoundException(
                'No creature found for id '.$id
            );
        }

        return $this->render('creature/show.html.twig',
            [
                'entity' => $creature
            ]);
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
