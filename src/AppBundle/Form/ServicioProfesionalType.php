<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServicioProfesionalType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('servicio')
                ->add('profesional')                
                ->add('status', ChoiceType::class, array(
                    'choices' => array('Activo' => 'activo', 'Inactivo' => 'inactivo'),
                    'required' => true,
                    'label' => 'Estatus',
                ))
                //->add('fechaActualizacion')
                ->add('observacion')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ServicioProfesional'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_servicioprofesional';
    }

}
