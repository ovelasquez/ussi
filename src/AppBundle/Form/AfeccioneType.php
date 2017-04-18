<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AfeccioneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('procedencia')
                ->add('diagnostico', TextareaType::class, array(
                    'label' => 'Diagnóstico',
                    'required' => true,
                    'attr' => array('placeholder' => ''),
                ))
                ->add('tratamiento', TextareaType::class, array(
                    'label' => 'Tratamiento',
                    'required' => true,
                    'attr' => array('placeholder' => ''),
                ))
                ->add('referencia')
                ->add('consulta')
                ->add('enterica_elemento')
                ->add('codigo')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Afeccione'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_afeccione';
    }


}
