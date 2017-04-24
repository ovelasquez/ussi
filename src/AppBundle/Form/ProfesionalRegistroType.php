<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProfesionalRegistroType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('codigoSsa')
                //->add('persona', PersonaType::class, array('label' => ' '))                 
                ->add('edoCivil', ChoiceType::class, array(
                    "mapped" => false,
                    'choices' => array('Soltero' => 'soltero', 'Casado' => 'casado', 'Viudo' => 'viudo', 'Divorsiado' => 'divorsiado', 'Concubino' => 'concubino'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Estado Civil'),
                    'label' => 'Estado Civil',
                ))

                ->add('fechaNacimiento', BirthdayType::class, array(
                    "mapped" => false,
                    'placeholder' => array(
                        'year' => 'Año', 'month' => 'Mes', 'day' => 'Día',
                    ),
                    'label' => 'Fecha Nacimiento',
                ))


                ->add('religion', EntityType::class, array(
                    'class' => 'AppBundle:Religion',
                    'choice_label' => 'nombre',
                    "mapped" => false,
                      'placeholder' => 'Seleccione',
                      
                ))
               
                ->add('etnia', EntityType::class, array(
                    'class' => 'AppBundle:Etnia',
                    'choice_label' => 'nombre',
                    "mapped" => false,
                    'placeholder' => 'Seleccione',
                    'required'=>false,
                    'placeholder' => 'Seleccione',
                ))


        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Profesional'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_profesional';
    }

}
