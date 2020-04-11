<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;


class SearchTrajetType extends AbstractType
{
    CONST PRICE = [5, 10 , 15, 20, 25, 30, 35, 40, 45, 50, 60, 70, 100];

    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
        $builder
            ->add('ville_depart', TextType::class, [
                'label' => 'D\'où voulez-vous partir ?',
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('ville_arrivee', TextType::class, [
                'label' => 'Jusqu\'à ?',
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('date_depart', DateType::class, [
                'label' => 'À partir de quel jour ?', 
            ])
            ->add('heure_depart', TimeType::class, [
                'label' => 'Heure de départ',
                'constraints' => [new NotBlank(),
                ]
            ])
            /*
            /*->add('heure_arrivee', TimeType::class, [
                'label' => 'À partir de quelle heure ?',
            ])*/
            ->add('nb_places', IntegerType::class, [
                'label' => 'Nombre de places minimum',
            ])
            ->add('maximum_price', ChoiceType::class, [
                'label' =>  'Prix maximum',
                'choices' => array_combine(self::PRICE, self::PRICE),
            ])
        ;
    }

    /*
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
    */
}
