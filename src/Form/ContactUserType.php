<?php

namespace App\Form;

use App\Entity\ContactUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,array(
                'label' => 'Email',
                'attr' => array(
                    'placeholder' => 'Votre email ici ...',
                    'pattern' =>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$' // html5 emails allow aa@aa emails so force to get the domain
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactUser::class,
        ]);
    }
}
