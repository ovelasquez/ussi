<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ServicioProfesionalType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('servicio', EntityType::class, array(
                    'class' => 'AppBundle:Servicio',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->orderBy('u.especialidad', 'ASC');
                    },
                    
                    'placeholder' => 'Seleccione',
                ))
                ->add('profesional')
                ->add('status', ChoiceType::class, array(
                    'choices' => array('Activo' => 'activo', 'Inactivo' => 'inactivo'),
                    'required' => true,
                    'label' => 'Estatus',
                ))
                //->add('fechaActualizacion')
                ->add('observacion')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ServicioProfesional'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_servicioprofesional';
    }

}
