<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, $this->getConfig('Nom','Entrez votre nom', ['required' => 'required']))
            ->add('prenom', TextType::class, $this->getConfig('Prénom','Entrez votre prénom', ['required' => 'required']))
            ->add('email', EmailType::class, $this->getConfig('Email','Entrez votre email', ['required' => 'required']))
            ->add('message', TextareaType::class, $this->getConfig('Message','Entrez votre message', ['required' => 'required']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
