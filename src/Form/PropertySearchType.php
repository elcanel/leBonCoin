<?php

namespace App\Form;


use App\Entity\Animaux;
use App\Entity\Immobilier;
use App\Entity\Multimedia;
use App\Entity\PropertySearch;
use App\Entity\Vehicules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class PropertySearchType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', ChoiceType::class, [

                'label' => false,
                'required' => false,
                'choices' => [
                    'Catégorie' => $this->getChoices()
                    ]
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget Max'
                ]
            ]);




        $formModifier = function (FormInterface $form, PropertySearch $PropertySearch) {
            //dd($PropertySearch);

            if($PropertySearch->getCategorie() == 1){
                $form
                    ->add('type_anim', ChoiceType::class, [
                    'attr' => [
                        'placeholder' => 'Type d\'animal'],
                    'required' => false,
                    'label' => false,
                        'choices' => [
                            'Type d\'animal' => $this->getAnimaux()
                        ]
                ]);
            }


            if($PropertySearch->getCategorie() == 2){
                $form
                    ->add('type_immo', ChoiceType::class, [
                    'attr' => [
                        'placeholder' => 'Type de bien'],
                    'required' => false,
                    'label' => false,
                        'choices' => [
                            'Type de bien immobilier' => $this->getImmos()
                        ]
                    ])
                    ->add('surface_immo', IntegerType::class, [
                    'attr' => [
                        'placeholder' => 'Surface'],
                    'required' => false,
                        'label' => false ])
                    ->add( 'nb_piece_immo', IntegerType::class, [
                    'attr' => [
                        'placeholder' => 'Nombre de pièce'],
                    'required' => false,
                        'label' => false ]);
            }


            if($PropertySearch->getCategorie() == 3){
                $form
                    ->add('type_multi', ChoiceType::class, [
                        'attr' => [
                            'placeholder' => 'Type de multimédia'],
                        'required' => false,
                        'label' => false,
                        'choices' => [
                            'Type de multimédia' => $this->getMultis()
                        ]
                    ])
                    ->add('marque_multi', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Marque'],
                    'required' => false,
                        'label' => false ]);
            }


            if($PropertySearch->getCategorie() == 4){
                $form
                    ->add('type_vehi', ChoiceType::class, [
                    'attr' => [
                        'placeholder' => 'Type de véhicule'],
                    'required' => false,
                        'label' => false,
                        'choices' => [
                            'Type de véhicule' => $this->getVehis()
                        ]
                    ])
                    ->add('nb_km_vehi', IntegerType::class, [
                    'attr' => [
                        'placeholder' => 'Nombre de km'],
                    'required' => false,
                        'label' => false ])
                    ->add( 'energie_vehi', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Type d\'énergie'],
                    'required' => false,
                        'label' => false ])
                    ->add('annee_vehi', IntegerType::class, [
                    'attr' => [
                        'placeholder' => 'Année'],
                    'required' => false,
                        'label' => false ]);
            }

        };


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $formModifier($event->getForm(), $event->getData());
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection'=> false,

        ]);
    }

    private function getChoices()
    {
        $choices = PropertySearch::CAT;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }private function getAnimaux()
    {
        $choices = Animaux::TYPE;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }

    private function getImmos()
    {
        $choices = Immobilier::TYPE;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }

    private function getMultis()
    {
        $choices = Multimedia::TYPE;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }

    private function getVehis()
    {
        $choices = Vehicules::TYPE;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }

    public function getBlockPrefix()
    {
        return '';
    }
}