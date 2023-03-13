<?php

namespace App\Form;

use App\Entity\IngredientRecette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('unite',TextType::class,[
                'label' => 'Unité',
                'attr' => [
                    'placeholder' => 'Unité'
                ]
            ])
            ->add('quantite',TextType::class,[
                'label' => 'Quantité',
                'attr' => [
                    'placeholder' => 'Quantité'
                ]
            ])
            ->add('ingredient',EntityType::class,[
                'class' => 'App\Entity\Ingredient',
                'choice_label' => 'nom',
                'label' => 'Ingrédient',
                'attr' => [
                    'placeholder' => 'Ingrédient'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IngredientRecette::class,

        ]);
    }
}
