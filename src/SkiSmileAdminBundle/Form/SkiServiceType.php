<?php

namespace SkiSmileAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkiServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', null, array(
                'label' => 'Послуга',
                'required' => true
            ))
            ->add('price', null, array(
                'label' => 'Ціна',
                'required' => true
            ))
            ->add('retail', null, array(
                'label' => 'Роздріб',
                'required' => false
    ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SkiSmileAdminBundle\Entity\SkiService'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'skismilebundle_skiservice';
    }


}
