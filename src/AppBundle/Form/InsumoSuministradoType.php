<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InsumoSuministradoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('tipoInsumo', EntityType::class, array(
                    'class' => 'AppBundle:TiposInsumo',
                    'choice_label' => 'nombre',
                    'mapped' => false,
                        //'placeholder' => 'Seleccione',
                ))
                ->add('cantidad')
                ->add('fecha')
                ->add('consulta')
                ->add('usuario')
                ->add('insumo');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InsumoSuministrado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_insumosuministrado';
    }

}
