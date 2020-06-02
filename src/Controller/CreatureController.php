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
     * Create a new creature entity in the database.
     * 
     * @Route("/create", name="creature_create", methods={"POST"})
     */
    public function createAction(Request $request): Response
    {
        $entity = new Creature();
        
        $form = $this->createForm(CreatureType::class, $entity);
        $form->submit($request);

        if ($form->isValid())
        {
            $this->repository->save($entity);
            $targetUrl = $this->generateUrl('creature_show', array('id' => $entity->getId()));
            return $this->redirect($targetUrl);
        }

        return $this->render('creature/new.html.twig',
        [
            'entity' => $entity,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="creature_new")
     */
    public function newAction(): Response
    {
        $creature = new Creature();

        $form = $this->createForm(CreatureType::class, $creature);

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
}
