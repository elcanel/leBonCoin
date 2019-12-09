<?php

namespace App\Form;


use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
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
                'choices' => $this->getChoices()
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget Max'
                ]
            ]);




        $formModifier = function (FormInterface $form, PropertySearch $PropertySearch) {
            if($PropertySearch)
            {
                //dd($PropertySearch);
                if($PropertySearch->getCategorie() == 1){
                    $form->add('animaux', AnimauxType::class, [
                        'label' => ' ',
                        'required' => false
                    ]);
                }
                if($PropertySearch->getCategorie() == 2){
                    $form->add('immobilier', ImmobilierType::class, [
                        'label' => ' ',
                        'required' => false
                    ]);
                }
                if($PropertySearch->getCategorie() == 3){
                    $form->add('multimedia', MultimediaType::class, [
                        'label' => ' ',
                        'required' => false
                    ]);
                }
                if($PropertySearch->getCategorie() == 4){
                    $form->add('vehicules', VehiculesType::class, [
                        'label' => ' '
                    ]);
                }
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

    }

    public function getBlockPrefix()
    {
        return '';
    }
}