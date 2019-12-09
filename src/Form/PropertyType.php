<?php

namespace App\Form;


use App\Entity\Property;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title')

            ->add('cat',ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => $this->getChoices()
            ])
            ->add('description')
            ->add('prix')
            ->add('lieu')
            ->add('sold')




        ;

        $formModifier = function (FormInterface $form, Property $Property = null) {
            if($Property)
            {
                if($Property->getCat() == 1){
                    $form->add('animaux', AnimauxType::class, [
                        'label' => ' '
                    ]);
                }
                if($Property->getCat() == 2){
                    $form->add('immobilier', ImmobilierType::class, [
                        'label' => ' '
                    ]);
                }
                if($Property->getCat() == 3){
                    $form->add('multimedia', MultimediaType::class, [
                        'label' => ' '
                    ]);
                }
                if($Property->getCat() == 4){
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
/*
        $builder->get('cat')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $cat = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $cat);
            }
        );

*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Property::CAT;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }


}
