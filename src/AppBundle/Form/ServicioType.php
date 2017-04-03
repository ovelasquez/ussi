<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServicioType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('especialidad')
                
                ->add('dia', ChoiceType::class, array(
                    'choices' => array('Domingo' => '0', 'Lunes' => '1', 'Martes' => '2', 'Miércoles' => '3', 'Jueves' => '4', 'Viernes' => '5', 'Sábado' => '6'),
                    'required' => true,
                    'label' => 'Día',
                ))
                
                ->add('turno', ChoiceType::class, array(
                    'choices' => array('Mañana' => 'mañana', 'Tarde' => 'tarde', 'Mixto' => 'mixto', 'Nínguno' => 'ninguno'),
                    'required' => true,
                    'label' => 'Turno',
                ))
                
                ->add('procedencia', ChoiceType::class, array(
                    'choices' => array('UBV' => 'UBV', 'Comunidad' => 'Comunidad', 'Mixto' => 'Mixto'),
                    'required' => true,
                    'label' => 'Procedencia',
                ))
                
                ->add('cupo')


        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Servicio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_servicio';
    }

}
