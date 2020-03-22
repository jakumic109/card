<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Description of FileClass
 *
 * @author jakub.michulec
 */

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class FileClass {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    private $fileName;
    private $fileContent;
    
    public function __construct($fileName = '', $fileContent = '') {
        $this->fileName = $fileName;
        $this->fileContent = $fileContent;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getFileName(){
        return $this->fileName;
    }
    
    public function getFileContent(){
        return $this->fileContent;
    }
    
    public function setFileName($fileName){
        $this->fileName = $fileName;
    }
    
    public function setFileContent($fileContent){
        $this->fileContent = $fileContent;
    }
}
