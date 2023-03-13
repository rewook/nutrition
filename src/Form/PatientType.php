<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Regime;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Email',
            ])

            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('telephone',TextType::class)
            ->add('allergene',EntityType::class,[
                'class' => Allergene::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Allergènes',
                'attr' => ['class' => 'mt-3'],
            ])
            ->add('regime',EntityType::class,[
                'class' => Regime::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Régimes',
                'attr' => ['class' => 'mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
