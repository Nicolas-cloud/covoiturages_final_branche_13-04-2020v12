<?php

namespace App\Form;

use App\Entity\Trajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville_depart', TextType::class, [
                'constraints' => [new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('ville_arrivee', TextType::class, [
                'constraints' => [new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('heure_depart', TimeType::class, [
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('heure_arrivee', TimeType::class, [
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('prix', NumberType::class)
            ->add('nb_places', IntegerType::class)
            ->add('description', TextareaType::class)
            ->add('date_creation', DateType::class)
            ->add('date_modification', DateType::class)
            ->add('date_expiration', DateType::class, [
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('slug', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
