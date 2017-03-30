<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProfesionalType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('codigoSsa')
                ->add('persona', PersonaType::class, array('label' => ' '))
                ->add('edoCivil', ChoiceType::class, array(
                    "mapped" => false,
                    'choices' => array('Soltero' => 'soltero', 'Casado' => 'casado', 'Viudo' => 'viudo', 'Divorsiado' => 'divorsiado', 'Concubino' => 'concubino'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Estado Civil'),
                    'label' => 'Estado Civil',
                ))
                ->add('analfabeta', CheckboxType::class, array(
                    "mapped" => false,
                    'label' => 'Es Analfabeta?',
                    'required' => false,
                ))
                ->add('ocupacion', TextType::class, array(
                    "mapped" => false,
                    'label' => 'Ocupación',
                    'required' => true,
                    'attr' => array('placeholder' => 'Ocupación'),
                ))
                ->add('estudio', ChoiceType::class, array(
                    "mapped" => false,
                    'choices' => array('Primaria' => 'primaria', 'Secundaria' => 'secundaria', 'Universitaria' => 'universitaria', 'Otro' => 'otro'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Nivel de Instrucción'),
                    'label' => 'Nivel de Instrucción',
                ))
                ->add('anoAprobado', ChoiceType::class, array(
                    "mapped" => false,
                    'choices' => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'),
                    'required' => false,
                    'label' => 'Años Aprobados',
                    'attr' => array('placeholder' => 'Años Aprobados')
                ))
                ->add('fechaNacimiento', BirthdayType::class, array(
                    "mapped" => false,
                    'placeholder' => array(
                        'year' => 'Año', 'month' => 'Mes', 'day' => 'Día',
                    ),
                    'label' => 'Fecha Nacimiento',
                ))
                ->add('apellidoFamilia', TextType::class, array(
                    "mapped" => false,
                    'label' => 'Apellido Familia',
                    'required' => true,
                    'attr' => array('placeholder' => 'Apellido Familia'),
                ))
                ->add('cedulaJefeFamilia', TextType::class, array(
                    "mapped" => false,
                    'label' => 'Cédula del Jefe Familia',
                    'required' => true,
                    'attr' => array('placeholder' => 'Cédula del Jefe Familia'),
                ))
                ->add('comunidad', ChoiceType::class, array(
                    "mapped" => false,
                    'choices' => array('Estudiante de Pregrado' => 'pfg', 'Estudiante de Postgrado' => 'pfa', 'Docente' => 'docente', 'Administrativo' => 'administrativo', 'Obrero' => 'obrero', 'Jubilado' => 'jubilado', 'Comunidad' => 'comunidad'),
                    'required' => true,
                    'attr' => array('placeholder' => 'Comunidad'),
                    'label' => 'Comunidad',
                ))
               
                ->add('religion', EntityType::class, array(                    
                    'class' => 'AppBundle:Religion',                    
                    'choice_label' => 'nombre',
                    "mapped" => false,                       
                ))
                
                 ->add('pfg', EntityType::class, array(                    
                    'class' => 'AppBundle:Pfg',                    
                    'choice_label' => 'nombre',
                    "mapped" => false,                       
                ))
                 ->add('etnia', EntityType::class, array(                    
                    'class' => 'AppBundle:Etnia',                    
                    'choice_label' => 'nombre',
                    "mapped" => false,                       
                ))
                
                
           /*     ->add('direccion', CollectionType::class, array(
                    "mapped" => false,
                    'entry_type' => DireccionType::class,
                    'label' => 'Direcciones',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'my-direccion',
                    ),
                ))
                ->add('familiar', CollectionType::class, array(
                    "mapped" => false,
                    'entry_type' => FamiliarType::class,
                    'label' => 'Familiares',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'my-familiar',
                    ),
                ))
                */

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
