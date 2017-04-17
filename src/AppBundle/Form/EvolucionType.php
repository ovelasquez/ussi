<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EvolucionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('subjetivo', TextareaType::class, array(
                    'label' => 'Motivo de la Consulta',
                    'required' => true,
                    'attr' => array('placeholder' => '(S) Subjetivo'),
                ))
                ->add('objetivo' , TextareaType::class, array(
                    'label' => 'Enfermedad Actual y hallazgos',
                    'required' => true,
                    'attr' => array('placeholder' => '(O) Objetivo'),
                ))                
                ->add('apreciacion',TextareaType::class, array(
                    'label' => 'Diagnóstica',
                    'required' => true,
                    'attr' => array('placeholder' => '(A) Apreciación'),
                ))
                ->add('frecuencia', ChoiceType::class, array(
                    'choices' => array('Primera' => 'primera', 'Sucesiva' => 'sucesiva', 'Emergencia' => 'emergencia'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Frecuencia de Consulta'),
                    'label' => 'Frecuencia de Consulta',))
                
                ->add('tratamiento' ,TextareaType::class, array(
                    'label' => 'Tratamientos Pendiente',
                    'required' => true,
                    'attr' => array('placeholder' => '(P) Plan: Tratamiento Educa. Terap. Y Pendiente'),
                ))
                ->add('edad');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evolucion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_evolucion';
    }


}
