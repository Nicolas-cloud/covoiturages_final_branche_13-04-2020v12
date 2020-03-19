<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SearchTrajetType extends AbstractType
{
    CONST PRICE = [5, 10 , 15, 20];

    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
        $builder
            ->add('ville_depart', TextType::class)
            ->add('ville_arrivee', TextType::class)
            ->add('nb_places', IntegerType::class)
            ->add('minimum_price', ChoiceType::class, [
                'label' =>  'Prix minimum',
                'choices' => array_combine(self::PRICE, self::PRICE)
            ])
            ->add('maximum_price', ChoiceType::class, [
                'label' =>  'Prix maximum',
                'choices' => array_combine(self::PRICE, self::PRICE),
            ])
            ->add('recherche', SubmitType::class)
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
