<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

/**
 * Description of GetFileForm
 *
 * @author jakub.michulec
 */
class GetFileForm extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('file', FileType::class,[
            'label' => 'Load your file',
            'mapped' => false,
            'constraints' => [
                new File([
                    'maxSize' => '2014k',
                    'mimeTypesMessage' => 'Please upload a valid txt file'
                ])
            ]
        ])->add('add', SubmitType::class,[
            'label' => 'Upload file'
        ]);
    }
}
