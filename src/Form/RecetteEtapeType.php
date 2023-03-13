<?php

namespace App\Form;

use App\Entity\Etape;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RecetteEtapeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero',IntegerType::class,[
                'label' => 'Numéro',
                'attr' => [
                    'placeholder' => 'Numéro'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('photo',FileType::class,[
                'label' => 'Photo',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'le fichier doit être une image (jpeg ou png)',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etape::class,
        ]);
    }
}
