<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoriaOdontologicaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('tratamientoMedico')
                ->add('medicamentoActual')
                ->add('alergia')
                ->add('ultimaVisitaOdontologo')
                ->add('tratamientoAplicado')
                ->add('dolorBoca')
                ->add('sangreEncias')
                ->add('habitos')
                ->add('presionArterial')
                ->add('hepatitis')
                ->add('tbc')
                ->add('enfermedadRespiratoria')
                ->add('enfermedadCardiovascular')
                ->add('enfermedadHemorragica')
                ->add('enfermedadOtra')
                ->add('enfermedadFamiliar')
                ->add('estaEmbarazada')
                ->add('observaciones')
                ->add('paciente')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\HistoriaOdontologica'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_historiaodontologica';
    }


}
