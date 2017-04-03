<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EsperandoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('paciente')
                ->add('especialidad')
                ->add('profesional')
                ->add('penalizacion')
                ->add('posicion')
                ->add('fechaRegistro')
                ->add('status', ChoiceType::class, array(
                    'choices' => array('Activo' => 'activo', 'Atendido' => 'atendido', 'Abandono' => 'abandono', 'Procesando' => 'procesando', 'Cancelado' => 'cancelado'),
                    'required' => true,
                    'label' => 'Turno',
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Esperando'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_esperando';
    }

}
