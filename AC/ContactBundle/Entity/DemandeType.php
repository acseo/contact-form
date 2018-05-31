<?php

namespace AC\ContactBundle\Entity;

use AC\ContactBundle\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class DemandeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $builder = $event->getForm();
            $builder->add('demande', TextareaType::class, array(
                'required' => true,
            ));
            $builder->add('traite', CheckboxType::class, array(
                'required' => FALSE,
            ));
        });
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Demande::class,
        ));
    }

}
