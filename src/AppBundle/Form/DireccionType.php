<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DireccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('tipo', ChoiceType::class, array(
                    'choices' => array('Habitación' => 'habitacion', 'Lugar Nacimiento' => 'nacimiento'),                    
                    'label' => 'Tipo *',                                       
                ))
                
                 ->add('sector', TextType::class, array(
                    'label' => 'Sector',                                                         
                ))
                
                ->add('parroquia')
                //->add('paciente')        
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Direccion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_direccion';
    }


}
