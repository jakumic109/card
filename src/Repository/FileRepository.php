<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repository;

use App\Entity\FileClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Description of FileRepository
 *
 * @author jakub.michulec
 */
class FileRepository extends ServiceEntityRepository{
    
    private $conn;
    
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, FileClass::class);
        $this->conn = $this->getEntityManager()->getConnection();
    }
    
    public function insertFile($fileObject){
        $result = $this->conn->insert('file',['fileName' => $fileObject->getFileName(), 'fileContent' => $fileObject->getFileContent()]);
        if($result){
            $query = "select max(id) as id from file";
            $result = $this->conn->fetchAssoc($query);
        }
    }
}
