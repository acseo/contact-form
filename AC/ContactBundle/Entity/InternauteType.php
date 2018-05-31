<?php

namespace AC\ContactBundle\Entity;

use AC\ContactBundle\Entity\Internaute;
use AC\ContactBundle\Entity\DemandeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class InternauteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('demande', CollectionType::class, array(
                    'entry_type' => DemandeType::class
		));
   
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $builder = $event->getForm();
            $required = true;
            $builder->add('nom', TextType::class, array(
                'required' => $required,
            ));
            $builder->add('email',EmailType::class, array(
                'required' => $required,
            ));
        });
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Internaute::class,
        ));
    }

}
