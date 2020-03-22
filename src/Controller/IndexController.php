<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\HandClass;
use App\Entity\FileClass;
use App\Form\GetFileForm;

#use Doctrine\DBAL\Driver\Connection;

/**
 * Description of IndexController
 *
 * @author jakub.michulec
 */
class IndexController extends AbstractController{
    
    public function index(Request $request){
        $winsResult = [];
        $form = $this->createForm(GetFileForm::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $uploadedFile = $form->get('file')->getData();
            $contentFile = file_get_contents($uploadedFile);
            $fileObject = new FileClass($uploadedFile->getClientOriginalName(),$contentFile);
            $fileRepo = $this->getDoctrine()->getRepository(FileClass::class);
            $fileId = $fileRepo->insertFile($fileObject);
            $allFileRows = explode("\n",$contentFile);
            $p1win = 0;
            $p2win = 0;
            $draw = 0;
            foreach($allFileRows as $fileRow){
                if($fileRow != ''){
                    $rowCards = explode(" ",$fileRow);
                    $handP1 = new HandClass($fileId);
                    $handP2 = new HandClass($fileId);
                    foreach($rowCards as $keyCard => $valueCard){
                        if($keyCard < 5){
                            $handP1->addCard($valueCard);
                        }else{
                            $handP2->addCard($valueCard);
                        }
                    }
                    if($handP1->getCardsRank() < $handP2->getCardsRank()){
                        ++$p1win;
                    }elseif($handP2->getCardsRank() < $handP1->getCardsRank()){
                        ++$p2win;
                    }else{
                        ++$draw;
                    }
                }
            }
            
            $winsResult = [
                    'p1win' => $p1win,
                    'p2win' => $p2win,
                    'draw' => $draw,
                ];
        }
        
        return $this->render('Index/index.html.twig',[
            'form' => $form->createView(),
            'winsResult' => $winsResult
        ]);
    }
}
