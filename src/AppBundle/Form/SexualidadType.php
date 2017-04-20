<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SexualidadType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('menarquia')
                ->add('cicloMenstrual')
                ->add('prSexual')
                ->add('frecuenciaSexual')
                ->add('numeroParejas')
                ->add('dispareunia')
                ->add('anticonceptivos')
                ->add('menopausia')
                ->add('andropausia')
                ->add('gesta')
                ->add('parto')
                ->add('cesarea')
                ->add('aborto')
                ->add('edad1erParto')
                ->add('fechaUltimoParto')
                ->add('curetaje')
                ->add('numeroHijosVivos')
                ->add('numeroHijosMuertos')
                ->add('pesoUltimoHijo')
        // ->add('fechaActualizacion')
        //->add('fechaRegistro')
        //->add('paciente')    
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sexualidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_sexualidad';
    }

}
