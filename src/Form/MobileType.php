<?php

namespace App\Form;

use App\Entity\Mobile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MobileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('screen')
            ->add('design')
            ->add('colour')
            ->add('android')
            ->add('processor')
            ->add('ram')
            ->add('camera')
            ->add('storage')
            ->add('drums')
            ->add('sim_card')
            ->add('compatibility')
            ->add('sav')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mobile::class,
        ]);
    }
}
