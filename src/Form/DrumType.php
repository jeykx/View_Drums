<?php

namespace App\Form;

use App\Entity\Drum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DrumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('dimension_gc')
            ->add('futs')
            ->add('model')
            ->add('price')
            ->add('woodtype')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Drum::class,
            'translation_domain' => 'forms'
        ]);
    }
}
