<?php

namespace App\Form;

use App\Entity\Immobilier;
use Symfony\Component\DependencyInjection\Tests\Compiler\I;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImmobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('type',ChoiceType::class, [
                'label' => 'Type de bien immobilier',
                'choices' => $this->getChoices()
            ])
            ->add('surface', IntegerType::class, [
                'label' => 'Surface en m²'
            ])
            ->add('nb_piece', IntegerType::class, [
                'label' => 'Nombre de pièce(s)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Immobilier::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Immobilier::TYPE;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }


}
