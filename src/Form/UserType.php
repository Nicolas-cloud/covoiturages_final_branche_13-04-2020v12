<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir une adresse email'
                    ])
                ]
            ])
            ->add('roles', CollectionType::class, [
            'entry_type'   => ChoiceType::class,
            'entry_options'  => [
                'label' => false,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                ],
            ],
            'label' => 'Rôle',
            ])
            ->add('password', PasswordType::class)
            ->add('password_confirm', PasswordType::class)

                    //'type' => PasswordType::class,
                    //'first_options'  => array('label' => 'Mot de passe'),
                    //'second_options' => array('label' => 'Confirmer le mot de passe'),
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir votre nom'
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir votre  prénom'
                    ])
                ]
            ])   
            ->add('pseudo', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un pseudo'
                    ])
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme', 
                ]
            ])
            ->add('annee_naissance', BirthdayType::class, [
                'placeholder' => 'Select',
                'label' => 'Date de naissance'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
