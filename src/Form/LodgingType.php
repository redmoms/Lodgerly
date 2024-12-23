<?php

namespace App\Form;

use App\Entity\Amenities;
use App\Entity\Lodging;
use App\Entity\LodgingCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LodgingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('adress')
            ->add('price_per_night')
            ->add('animals_allowed')
            ->add('simple_bed_count')
            ->add('double_bed_count')
            ->add('bedroom_count')
            ->add('description')
            ->add('lodging_category', EntityType::class, [
                'class' => LodgingCategory::class,
                'choice_label' => 'id',
            ])
            ->add('amenities', EntityType::class, [
                'class' => Amenities::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lodging::class,
        ]);
    }
}
