<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatologiaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('alergias')
                ->add('asma')
                ->add('neumonia')
                ->add('tbc')
                ->add('cardiotopia')
                ->add('hipertension')
                ->add('dislipidemias')
                ->add('varices')
                ->add('cardopatiaChag')
                ->add('hepatopatia')
                ->add('desnutricion')
                ->add('diabetes')
                ->add('obesidad')
                ->add('gastroenteritis')
                ->add('encoprexis')
                ->add('enfermedadRenal')
                ->add('eunereis')
                ->add('cancer')
                ->add('tromboembolia')
                ->add('tumorM')
                ->add('meningitis')
                ->add('tCraneoenc')
                ->add('enfermedadErup')
                ->add('dengue')
                ->add('hospitalizacion')
                ->add('intervencionQuirurgica')
                ->add('accidente')
                ->add('artritis')
                ->add('enfermedadTs')
                ->add('enfermedadInTran')
                ->add('malaria')
                ->add('hansenLeishmar')
                ->add('otros')
                //->add('fechaRegistro')
                //->add('fechaActualizacion')
                //->add('paciente')  
                      ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Patologia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_patologia';
    }


}
