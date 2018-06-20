<?php

namespace Souk\FrontEndBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle')
            ->add('description')
            ->add('dateevent')
            ->add('image')
            ->add('idlieu', EntityType::class,array(

        'class' => 'SoukFrontEndBundle:Lieu',
        'choice_label'=>'libelle',
        'multiple'=>false

    ))
            ->add('idtypeevent',EntityType::class,array(

            'class' => 'SoukFrontEndBundle:Typeevent',
            'choice_label'=>'libelle',
             'multiple'=>false

        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Souk\FrontEndBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'souk_frontendbundle_event';
    }


}
