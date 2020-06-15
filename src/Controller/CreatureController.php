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
    public function indexAction() : Response
    {
        $creatures = $this->repository->findAll();
        
        return $this->render('creature/index.html.twig',
            [
                'entities' => $creatures
            ]);
    }

    /**
     * Show a single creature.
     * 
     * @Route("/show/{id}", name="creature_show")
     */
    public function showAction($id) : Response
    {
        $creature = $this->repository->findById($id);

        if (!$creature)
        {
            throw $this->createNotFoundException('No creature found for id '. $id);
        }

        return $this->render('creature/show.html.twig',
            [
                'entity' => $creature
            ]
        );
    }

    /**
     * Display a form to create a creature.
     * 
     * @Route("/new", name="creature_create")
     */
    public function createAction(Request $request): Response
    {
        $creature = new Creature();
        
        $form = $this->createForm(CreatureType::class, $creature,
            [
                'action' => $this->generateUrl('creature_create')
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->repository->save($creature);            
            return $this->redirectToRoute('creature_index');
        }

        return $this->render('creature/new.html.twig',
            [
                'creature_form' => $form->createView()
            ]
        );
    }

    /**
     * Display a form to edit a creature.
     * 
     * @Route("/edit/{id}", name="creature_edit")
     */
    public function editAction(Request $request, $id) : Response
    {
        $creature = $this->repository->findById($id);

        if (!$creature)
        {
            throw $this->createNotFoundException('No creature found for id '. $id);
        }

        $form = $this->createForm(CreatureType::class, $creature,
            [
                'action' => $this->generateUrl('creature_edit', array('id' => $id))
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->repository->save($creature);            
            return $this->redirectToRoute('creature_show', array('id' => $id));
        }

        return $this->render('creature/edit.html.twig',
            [
                'creature_name' => $creature->getName(),
                'creature_form' => $form->createView()
            ]
        );
    }


    /**
     * Delete a creature.
     * 
     * @Route("/delete/{id}", name="creature_delete")
     */
    public function deleteAction($id) : Response
    {
        $this->repository->removeById($id);

        return $this->redirectToRoute('creature_index');
    }

    /**
     * @Route("/graph", name="creature_graph")
     */
    public function graphAction() : Response
    {
        return new Response("foobar");
        
        $data = 'world';
        return $this->render('creature/graph.html.twig',
            [
                'data' => $data
            ]);
    }
}
