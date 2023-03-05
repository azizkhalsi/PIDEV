<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< Updated upstream
<<<<<<< HEAD
<<<<<<< Updated upstream
            ->add('nom')
            ->add('prenom')
=======
=======
>>>>>>> Stashed changes
            
            ->add('email')
            ->add('adresse')
            ->add('username')
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
            ->add('email')
            ->add('adresse')
>>>>>>> GestionUser
=======
>>>>>>> Stashed changes
            ->add('password',RepeatedType::class, [
                'type'=>PasswordType::class,
                'first_options'=>['label'=>'Password'],
                'second_options'=>['label'=>'Confirm Password']
            ])
            
            ->add('ajouter',SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
