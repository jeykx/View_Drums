<?php
namespace App\Controller;

use App\Entity\Drum;
use App\Repository\DrumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrumController extends AbstractController {
    
    /**
     * @var $repository;
     */
    private $repository;

    public function __construct(DrumRepository $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/drums", name="drum.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response {
        
        $drums = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1), 12
        );
        
        return $this->render('drum/index.html.twig', [
            'current_menu' => 'drums',
            'drums' => $drums
        ]);
    }
    /**
     * @Route("/drums/{slug}-{id}", name="drum.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Drum $drum, string $slug): Response {
        
        if ($drum->getSlug() !== $slug) {
            return $this->redirectToRoute('drum.show', [
                    'id' => $drum->getId(),
                    'slug' => $drum->getSlug()
            ], 301);
        }
        
        return $this->render('drum/show.html.twig', [
            'drum' => $drum,
            'current_menu' => 'drums'
        ]);
    }
}