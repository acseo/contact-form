<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;


class AppType extends AbstractType {
    
    /**
     * Permet la configuration d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfig($label, $placeholder,$options = []){
        //array_merge fusionne des tableau
        return array_merge([
            'label' => $label,
            'attr'  => ['placeholder' => $placeholder]
        ], $options);
    }
}