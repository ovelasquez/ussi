<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SignosVitalesSuministradosType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', ChoiceType::class, array(
                    'choices' => array(
                        'Presion Arterial (PA)' => 'presion arterial',
                        'Frecuencia Cardíaca (FC)' => 'frecuencia cardiaca',
                        'Frecuencia Respiratoria (FR)' => 'frecuencia respiratoria',
                        'Peso' => 'peso',
                        'Talla' => 'talla',
                        'Temperatura' => 'temperatura'
                    ),
                    'required' => true,
                    'label' => 'Dato',
                   'placeholder' => 'Seleccione',
                     
                ))
                ->add('fecha')
                ->add('valor')
                ->add('consulta')
                ->add('usuario');                
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SignosVitalesSuministrados'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_signosvitalessuministrados';
    }

}
