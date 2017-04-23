<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReposoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                 ->add('consulta')
                ->add('observacion', CKEditorType::class, array(
                    'label' => 'Descripción del Reposo',
                    'required' => true,
                    'config_name' => 'my_config',
                ))
                ->add('inicio', TextType::class,array(
                    'label' => 'Descripción del Reposo',
                    'required' => true,))               
                //->add('codigo')
               
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reposo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_reposo';
    }

}
