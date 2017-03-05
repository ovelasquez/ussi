<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FamiliarType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('parentesco', ChoiceType::class, array(
                    'choices' => array('Padre' => 'padre', 'Madre' => 'madre', 'Otro' => 'otro'),
                    'label' => 'Parentesco *',
                ))
                
                ->add('nombre', TextType::class, array(
                    'label' => 'Nombre *',
                ))
                
                ->add('ocupacion', TextType::class, array(
                    'label' => 'Ocupacion *',
                ))                
        //->add('paciente')       
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Familiar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_familiar';
    }

}
