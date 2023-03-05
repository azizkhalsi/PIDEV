<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Regex;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
                'attr' => ['placeholder' => 'Email',
                'class'=>"form-control-file"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'You should add Email.',
                    ]),
                ],
            ])
<<<<<<< Updated upstream
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
            ->add('username',TextType::class, [
                'attr' => ['placeholder' => 'username',
                'class'=>"form-control-file"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'You should add your username.',
                    ]),
                ],
            ])
<<<<<<< Updated upstream
=======
>>>>>>> GestionUser
=======
>>>>>>> Stashed changes
            ->add('adresse',TextType::class, [
                'attr' => ['placeholder' => 'adresse',
                'class'=>"form-control-file"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'You should add your adresse.',
                    ]),
                ],
            ])
           

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type'=>PasswordType::class,
                'first_options'=>['label'=>'Password'],
                'second_options'=>['label'=>'Confirm Password'],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
                        'message' => 'The password must contain at least one lowercase letter, one uppercase letter, one number and one special character.'
                    ])
                ],
                'attr' => ['placeholder' => 'Password',
                'class'=>"form-control-file"],
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