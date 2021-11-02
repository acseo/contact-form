<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AppType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, $this->getConfig('Nom','Entrez votre nom', ['required' => 'required']))
            ->add('prenom', TextType::class, $this->getConfig('Prénom','Entrez votre prénom', ['required' => 'required']))
            ->add('email', EmailType::class, $this->getConfig('E-mail','Entrez votre email', ['required' => 'required']))
            ->add('hash', PasswordType::class, $this->getConfig('Password','Entrez votre password', ['required' => 'required']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
