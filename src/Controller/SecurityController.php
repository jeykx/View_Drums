<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {
    
    /**
     * @route("/login", name="login")
     */
    public function login(AuthenticationUtils $AuthenticationUtils) {
        
        $error= $AuthenticationUtils->getLastAuthenticationError();
        $lastUsername = $AuthenticationUtils->getLastUsername();
            
        return $this->render('security/login.html.twig' , [
            
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}