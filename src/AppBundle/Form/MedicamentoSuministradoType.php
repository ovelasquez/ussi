<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MedicamentoSuministradoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('consulta')
                
                ->add('tipoMedicamento', EntityType::class, array(
                    'class' => 'AppBundle:TiposMedicamento',
                    'choice_label' => 'nombre',
                    'mapped' => false,
                    //'placeholder' => 'Seleccione',
                    ))
                
                
                ->add('medicamento', null, array('required' => true, 'label' => 'Medicamento Suministrado','placeholder' => 'Seleccione',))
                ->add('cantidad')
                ->add('viaAdministracion', ChoiceType::class, array(
                    'choices' => array(
                        'Endovenosa' => 'endovenosa',
                        'Oral' => 'Oral',
                        'Sublingual' => 'sublingual',
                        'Intramuscular' => 'intramuscular',
                        'Intradérmica' => 'intradérmica',
                    ),
                    'required' => true,
                    'label' => 'Vía de Administración',
                    'placeholder' => 'Seleccione',
                ))
                ->add('usuario', null, array('required' => true, 'label' => 'Profesional',))
                ->add('fecha');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MedicamentoSuministrado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_medicamentosuministrado';
    }

}
