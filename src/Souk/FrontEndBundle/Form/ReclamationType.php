<?php

namespace Souk\FrontEndBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder->add('sujet', ChoiceType::class, array(
            'choices' => array(
                'Produit défectueux' => 'Produit défectueux',
                'Produit endommagé ou cassé' => 'Produit endommagé ou cassé',
                'Information erronée dans le catalogue ou sur le site web' => 'Information erronée dans le catalogue ou sur le site web',
                'Manquant à la livraison' => 'Manquant à la livraison',
                'Produit commandé erroné' => 'Produit commandé erroné',
                'Produit livré non commandé' => 'Produit livré non commandé',
                'Problème de performance d\'un produit' => 'Problème de performance d\'un produit',
                'Autre' => 'Autre',
            ),
        ))
            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('dateProbleme',DateType::class)
            ->add('dateReclamation', DateType::class)
            ->add('file', FileType::class, array('label' => 'Fichier joint', 'required' => false))
            ->add('commande', EntityType::class, array(
                'class' => 'Souk\FrontEndBundle\Entity\Commande',
                'choice_label' => 'id',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Souk\FrontEndBundle\Entity\Reclamation',
            'user' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'souk_frontendbundle_reclamation';
    }


}
