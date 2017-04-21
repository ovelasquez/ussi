<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CitaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('consulta')
                ->add('paciente')
                ->add('especialidad')
                ->add('profesional')                
                ->add('fecha')
                ->add('prioridad', ChoiceType::class, array(
                    'choices' => array('Normal' => 'normal', 'Emergencia' => 'emergencia',),
                    'required' => true,
                    'label' => 'Prioridad',
                    'attr' => array('placeholder' => 'Seleccione')
                ))
                ->add('status', ChoiceType::class, array(
                    'choices' => array('Activa' => 'activo', 'Procesada' => 'procesada', 'Cancelada' => 'Ccncelada'),
                    'required' => true,
                    'label' => 'Estatus',
                    'attr' => array('placeholder' => 'Seleccione')
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cita'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_cita';
    }

}
