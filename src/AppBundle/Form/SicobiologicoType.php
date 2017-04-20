<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SicobiologicoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('alcohol')
                ->add('drogas')
                ->add('isecticidas')
                ->add('deportes')
                ->add('sedentarismo')
                ->add('suenio')
                ->add('chupaDedo')
                ->add('onicofagia')
                ->add('micciones')
                ->add('evacuaciones')
                ->add('stress')
                ->add('metalesPesados')
                ->add('alimentacion')
                ->add('cigarrillosDia')
        // ->add('fechaRegistro')
        //->add('fechaActualizacion')
        // ->add('paciente')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sicobiologico'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_sicobiologico';
    }

}
