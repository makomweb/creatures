<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Form\CreatureType;
use App\Repository\CreatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/index", name="creature_index")
     */
    public function indexAction()
    {
        $entities = $this->repository->findAll();
        
        return $this->render('creature/index.html.twig',
            [
                'entities' => $entities
            ]);
    }

    /**
     * Show a single creature entity.
     * 
     * @Route("/show/{id}", name="creature_show")
     */
    public function showAction($id)
    {
        $entity = $this->repository->findById($id);

        if (!$entity) {
            throw $this->createNotFoundException(
                'No creature found for id '.$id
            );
        }

        return $this->render('creature/show.html.twig',
            [
                'entity' => $entity
            ]);
    }

    /**
     * @Route("/new", name="creature_create")
     */
    public function createAction(Request $request): Response
    {
        $creature = new Creature();
        $creature->setAttack(666);

        $form = $this->createForm(CreatureType::class, $creature, [
            'action' => $this->generateUrl('creature_create')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->repository->save($creature);            
            return $this->redirectToRoute('creature_index');
        }

        return $this->render('creature/new.html.twig',
        [
            'creature_form' => $form->createView()
        ]);
    }

    /**
     * Display a form to edit a creature.
     * 
     * @Route("/edit/{id}", name="creature_edit")
     */
    public function editAction($id)
    {
        $entity = $this->repository->findById($id);

        if (!$entity) {
            throw $this->createNotFoundException(
                'No creature found for id '.$id
            );
        }
    }


    /**
     * Delete a creature.
     * 
     * @Route("/delete/{id}", name="creature_delete")
     */
    public function deleteAction($id)
    {
        $this->repository->removeById($id);

        return $this->redirectToRoute('creature_index');
    }
}
