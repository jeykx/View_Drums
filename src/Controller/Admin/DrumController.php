<?php

namespace App\Controller\Admin;

use App\Repository\DrumRepository;
use App\Form\DrumType;
use App\Entity\Drum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\Common\Persistence\ObjectManager;

class DrumController extends AbstractController 

{
    
    
    /**
     * @var DrumRepository
     */
    private $repository;
    
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(DrumRepository $repository, ObjectManager $em) 
    
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @route("/admin", name="admin.drum.index")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function index() 
    
    {
        $drums = $this->repository->findAll();
        return $this->render('admin/drum/index.html.twig', compact ('drums'));
    }
    
    /**
     * @Route("/admin/drum/create", name="admin.drum.new")
     */
    public function new(Request $request) 
    
    {
        $drum = new Drum();
        $form = $this->createForm(DrumType::class, $drum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($drum);
            $this->em->flush();
            $this->addFlash('success', 'Batterie ajouté avec succès');
            return $this->redirectToRoute('admin.drum.index');
        }

        return $this->render('admin/drum/new.html.twig', [
            'drum' => $drum,
            'form' => $form->createView()
        ]);

    }
    

    /**
     * @route("/admin/drum/{id}", name="admin.drum.edit", methods="GET|POST")
     * @param Drum $drum
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function edit(Drum $drum, Request $request)
    
    {
        $form = $this->createForm(DrumType::class, $drum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Modification validé');
            return $this->redirectToRoute('admin.drum.index');
        }

        
        return $this->render('admin/drum/edit.html.twig', [
            'drum' => $drum,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @route("/admin/drum/{id}", name="admin.drum.delete", methods="DELETE")
     * @param Drum $drum
     * @return Symfony\Component\HttpFoundation\RedirectResponse
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function delete(Drum $drum, Request $request) 
    
    {
        
        if ($this->isCsrfTokenValid('delete' . $drum->getId(), $request->get('_token'))) {
            
        $this->em->remove($drum);
        $this->em->flush();
        $this->addFlash('success', 'Batterie supprimé avec succès');
        
        }

        return $this->redirectToRoute('admin.drum.index');
        
    }

}