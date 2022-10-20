<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
