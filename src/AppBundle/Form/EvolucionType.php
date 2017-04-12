<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EvolucionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('subjetivo', TextType::class, array(
                    'label' => 'Motivo de la Consulta',
                    'required' => true,
                    'attr' => array('placeholder' => 'Motivo de la Consulta'),
                ))
                ->add('objetivo' , TextType::class, array(
                    'label' => 'Enfermedad Actual y hallazgos',
                    'required' => true,
                    'attr' => array('placeholder' => 'Enfermedad Actual y hallazgos'),
                ))                
                ->add('apreciacion',TextType::class, array(
                    'label' => 'Diagnóstica',
                    'required' => true,
                    'attr' => array('placeholder' => 'Diagnóstica'),
                ))
                ->add('frecuencia', ChoiceType::class, array(
                    'choices' => array('Primera' => 'primera', 'Sucesiva' => 'sucesiva', 'Emergencia' => 'emergencia'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Frecuencia de Consulta'),
                    'label' => 'Frecuencia de Consulta',))
                
                ->add('tratamiento' ,TextType::class, array(
                    'label' => 'Tratamientos Pendiente',
                    'required' => true,
                    'attr' => array('placeholder' => 'Tratamientos Pendiente'),
                )) ;
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
