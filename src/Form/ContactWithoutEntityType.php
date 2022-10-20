<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Valid;

class ContactWithoutEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 100])
                ],
                'label' => 'Nom',
                'data' => '',
                'empty_data' => '',
                'invalid_message_parameters' => 'Veuillez entrer votre nom',
                'required' => true,
                'attr' => ['class' => 'has-validation'],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5, 'max' => 255])
                ],
                'label' => 'Email',
                'data' => '',
                'empty_data' => '',
                'invalid_message_parameters' => 'Veuillez entrer votre email',
                'required' => true,
                'attr' => ['class' => 'has-validation'],
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'max' => 500]),
                ],
                'label' => 'Message',
                'data' => '',
                'empty_data' => '',
                'invalid_message_parameters' => 'Veuillez entrer votre message',
                'required' => true,
                'attr' => ['class' => 'has-validation'],
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'nom' => '',
            'email' => '',
            'message' => '',
            
        ]);
    }
}
