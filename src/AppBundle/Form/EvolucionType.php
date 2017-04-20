<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class EvolucionType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('subjetivo', CKEditorType::class, array(
                    'label' => 'Motivo de la Consulta - (S) Subjetivo',
                    'required' => true,
                    'config_name' => 'my_config',
                ))
                
                ->add('objetivo', CKEditorType::class, array(
                    'label' => 'Enfermedad Actual y Hallazgos - (O) Objetivo',
                    'required' => true,
                    'config_name' => 'my_config',
                    ))
                
                ->add('apreciacion', CKEditorType::class, array(
                    'label' => 'Diagnóstica - (A) Apreciación',
                    'required' => true,
                    'config_name' => 'my_config',
                    
                    ))
                
                ->add('tratamiento', CKEditorType::class, array(
                    'label' => 'Tratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente',
                    'required' => true,
                    'config_name' => 'my_config',
                    
                    ))
                
                ->add('frecuencia', ChoiceType::class, array(
                    'choices' => array('Primera' => 'primera', 'Sucesiva' => 'sucesiva', 'Emergencia' => 'emergencia'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Frecuencia de Consulta'),
                    'label' => 'Frecuencia de Consulta',))
                ->add('edad')
                ->add('consulta');
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evolucion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_evolucion';
    }

}
