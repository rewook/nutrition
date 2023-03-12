<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\IngredientRecette;
use App\Entity\Recette;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'label' => 'Titre',
            ])
            ->add('description',TextareaType::class,[
                'label' => 'Description',
            ])
            ->add('tempsPrepa',IntegerType::class,[
                'label' => 'Temps de préparation (en mn)',
            ])
            ->add('tempsRepos',IntegerType::class,[
                'label' => 'Temps de repos (en mn)',
            ])
            ->add('tempsCuisson',IntegerType::class,[
                'label' => 'Temps de cuisson (en mn)',
            ])
            ->add('public',ChoiceType::class,[
                'choices' => [
                    'OUI' => true,
                    'NON' => false,
                ],
                'attr' => ['class' => 'mt-3'],
                'label' => 'Recette publique ?',
                ])

            ->add('etape',CollectionType::class,[
                'entry_type' => EtapeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('allergene',EntityType::class,[
                'class' => Allergene::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
            ])

            ->add('regime',EntityType::class,[
                'class' => Regime::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
