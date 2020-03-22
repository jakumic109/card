<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Description of SecurityController
 *
 * @author jakub.michulec
 */
class SecurityController extends AbstractController{
    
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('Security/login.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    public function logout(){
        throw new \Exception('It should never happen');
    }
}
