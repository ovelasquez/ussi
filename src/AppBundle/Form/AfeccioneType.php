<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AfeccioneType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('diagnostico', CKEditorType::class, array(
                    'label' => 'Diagnóstico',
                    'required' => true,
                    'config_name' => 'my_config',
                ))
                ->add('tratamiento', CKEditorType::class, array(
                    'label' => 'Tratamiento',
                    'required' => true,
                    'config_name' => 'my_config',
                ))
                ->add('consulta')
                ->add('entericaElemento')
                ->add('capitulo', EntityType::class, array(
                    'class' => 'AppBundle:EntericaCapitulo',
                    'choice_label' => 'nombre',
                    'mapped' => false))
                ->add('grupo', EntityType::class, array(
                    'class' => 'AppBundle:EntericaGrupo',
                    'choice_label' => 'nombre',
                    'mapped' => false)
        );
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Afeccione'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_afeccione';
    }

}
