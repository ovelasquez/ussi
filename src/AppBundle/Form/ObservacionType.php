<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ObservacionType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                //->add('fecha')
                ->add('consulta')                
                ->add('tipo', ChoiceType::class, array(
                    'choices' => array('Cura' => 'cura', 'Sutura' => 'sutura', 'Retiro de Punto' => 'retiro de punto'),
                    'required' => true,
                    'label' => 'Dato',
                    'placeholder' => 'Seleccione',
                ))
                ->add('descripcion')
                ->add('fecha')
                ->add('usuario')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Observacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_observacion';
    }

}
