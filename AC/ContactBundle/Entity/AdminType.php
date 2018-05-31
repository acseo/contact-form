<?php

namespace AC\ContactBundle\Entity;

use AC\ContactBundle\Entity\Admin;
use AC\ContactBundle\Entity\DemandeAdminType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('demande', CollectionType::class, array(
                    'entry_type' => DemandeAdminType::class
		));
    }
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Admin::class,
        ));
    }
}
