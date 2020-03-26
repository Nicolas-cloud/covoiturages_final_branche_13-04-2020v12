<?php

namespace App\Form;

use App\Entity\Trajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville_depart', TextType::class, [
                'label' => 'Ville de départ',
                'disabled' => true,
            ])          
            ->add('ville_arrivee', TextType::class, [
                'label' => 'Ville d\'arrivée',
                'disabled' => true,
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
            ->add('prix', IntegerType::class, [
                'constraints' => [new NotBlank(),
                ]
            ])
            ->add('nb_places', IntegerType::class, [
                'label' => 'Nombre de places disponibles',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Informations supplémentaires',
            ])            
            ->add('date_creation', DateType::class, [
                'label' => 'Date de création',
                'disabled' => true,
            ])             
            //->add('date_modification')
            ->add('date_expiration', DateType::class, [
                'label' => 'Date d\'expiration',
                'constraints' => [new NotBlank(),
                ]
            ])            
            //->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
