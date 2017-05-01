<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ConfiguracionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroConsultas')
                ->add('servicioActualizado')
                ->add('tiempoEspera')->add('penalizacion')->add('campania') 
                 ->add('templateReposo', CKEditorType::class, array(
                    'label' => 'Templete Reposo',
                    'required' => true,
                    'config_name' => 'my_config',
                ))
                ->add('templateConstancia', CKEditorType::class, array(
                    'label' => 'Template Constancia',
                    'required' => true,
                    'config_name' => 'my_config',
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Configuracion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_configuracion';
    }


}
