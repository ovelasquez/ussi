<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AntecedenteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('alergia')                
                ->add('asma')
                ->add('tbc')
                ->add('cardiotopia')
                ->add('hipertension')
                ->add('varices')
                ->add('desnutricion')
                ->add('diabetes')
                ->add('obesidad')
                ->add('gastropatia')
                ->add('neurologica')
                ->add('enfermedadRenal')
                ->add('cancer')
                ->add('alcohol')
                ->add('drogas')
                ->add('sifilis')
                ->add('sida')
                ->add('artritis')
                ->add('otrosPadre')
                ->add('otrosMadre')
                ->add('otrosHermanos')
                ->add('otros')
                //->add('fechaActualizacion')->add('fechaRegistro')
                //->add('paciente')
                        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Antecedente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_antecedente';
    }


}
