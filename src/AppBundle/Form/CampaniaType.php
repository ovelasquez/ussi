<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CampaniaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre')
                ->add('imagen', CollectionType::class, array(
                    'entry_type' => ImagenCampaniaType::class,
                    'entry_options' => array(
                        'label' => 'Nueva Imagen',
                    ),
                    'label' => 'Agregar, mover, eliminar imagen',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'required' => true,
                    'attr' => array(
                        'class' => 'imagenes',
                    ),
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Campania'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_campania';
    }

}
