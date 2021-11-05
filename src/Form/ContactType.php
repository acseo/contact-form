<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contactUser',ContactUserType::class,array(
                'label' => ' '
            ))
            ->add('Name', TextType::class,array(
                'label' => 'Votre Nom',
                'attr' => array(
                        'placeholder' => 'Votre Nom ici ...'
                    )
            ))
            ->add('Message', TextareaType::class, array(
                'label' => 'Votre question ici',
                'attr' => array(
                    'placeholder' => 'Votre Message ici ...'
                )
            ))
            ->add('Valider', SubmitType::class,array(
                'attr' => array(
                    'class' => 'btn btn-primary mb-3'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}
