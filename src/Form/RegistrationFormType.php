<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'constraints'=> [
                    new NotBlank(),
                    new Email(['mode' => 'strict'])
                ],
                'attr'=>[
                    'placeholder'=>'email du patient',
                    'class'=>'form-control',
                ]
            ])
            ->add('prenom',TextType::class,[
                 'constraints'=> [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 50])
                ],
                'attr'=>[
                    'placeholder'=>'prénom du patient',
                    'class'=>'form-control',
                ]
            ])
            ->add('nom',TextType::class,[
                'constraints'=> [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 50])
                ],
                'attr'=>[
                    'placeholder'=>'nom du patient',
                    'class'=>'form-control',
                ]
            ])
            ->add('telephone',TextType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Merci de saisir un n° de téléphone de type 06 05 04 03 02',
                    ]),
                    new Length(['min' => 2, 'max' => 50])

                ],
                'attr'=>[
                    'placeholder'=>'06 05 04 03 02',
                    'class'=>'form-control',
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'placeholder'=>'',
                    'class'=>'form-control',
                    'autocomplete' => 'nouveau mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au minimun {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
