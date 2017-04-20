<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerinatalType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('carnetPerinatal')
                ->add('patologiaEmbarazo')
                ->add('patologiaParto')
                ->add('patologiaPuerperio')
                ->add('consultasPrenatales')
                ->add('edadGestacional')
                ->add('forceps')
                ->add('cesarea')
                ->add('parto')
                ->add('pesoNacer')
                ->add('talla')
                ->add('circunferencia')
                ->add('apagarMin')
                ->add('asfixia')
                ->add('reanimacion')
                ->add('patologiasRn')
                ->add('egresoRnSano')
                ->add('egresoRnPatologico')
                ->add('lactanciaExclusiva')
                ->add('lactanciaMixta')
                ->add('lactanciaAglactacion')
                ->add('madreFueraCasa')
                ->add('familiaMadre')
                ->add('familiaPadre')
                ->add('familiaHermanos')
                ->add('familiaOtros')
        // ->add('fechaRegistro')
        // ->add('fechaActualizacion')
        //->add('paciente')     
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Perinatal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_perinatal';
    }

}
