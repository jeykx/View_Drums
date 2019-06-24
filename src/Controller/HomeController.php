<?php
namespace App\Controller;

use App\Repository\DrumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

Class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param DrumRepository $repository
     * @return Response
     */
    public function index(DrumRepository $repository):Response {
        
        $drums = $repository->findLatest();
        
        return $this->render('pages/home.html.twig', [
            'drums' => $drums
        ]);
    }

}