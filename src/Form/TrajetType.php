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
                'label' => 'Ville de départ',
                'constraints' => [new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('ville_arrivee', TextType::class, [
                'label' => 'Ville d\'arrivée',
                'constraints' => [new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('heure_depart', TimeType::class, [
                'label' => 'Heure de départ',
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('heure_arrivee', TimeType::class, [
                'label' => 'Heure d\'arrivee',
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('prix', NumberType::class)
            ->add('nb_places', IntegerType::class, [
                'label' => 'Nombre de places',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Informations supplémentaires',
            ])
            ->add('date_creation', DateType::class, [
                'label' => 'Date de création',
            ])
            ->add('date_modification', DateType::class, [
                'label' => 'Date de modification',
            ])
            ->add('date_expiration', DateType::class, [
                'label' => 'Date d\'expiration',
                'constraints' => [new NotBlank(),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
