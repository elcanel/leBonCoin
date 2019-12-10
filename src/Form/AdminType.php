<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [ 'label' => 'Nom'])
            ->add('mail', EmailType::class)
            ->add('mdp', PasswordType::class, [ 'label' => 'Mot de Passe'])
            ->add('phone', NumberType::class, [
                'required' => false,
                'label' => 'Téléphone'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
            'translation_domain' => 'forms'
        ]);
    }
}
