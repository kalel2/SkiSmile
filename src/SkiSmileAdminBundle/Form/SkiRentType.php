<?php

namespace SkiSmileAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SkiRentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', TextType::class, array(
                'label' => 'Категорія',
                'required' => false
            ))
            ->add('inventory', TextType::class, array(
                'label' => 'Інвентар',
                'required' => true
            ))
            ->add('priceOne', null , array(
                'label' => '1 день',
                'required' => true
            ))
            ->add('priceTwo', null , array(
                'label' => '3-4 дні',
                'required' => true
            ))
            ->add('priceThree', null , array(
                'label' => '5-6 днів',
                'required' => true
            ))
            ->add('priceFour', null , array(
                'label' => '7-8 днів',
                'required' => true
            ))
            ->add('guarantee', null , array(
                'label' => 'Застава',
                'required' => true
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SkiSmileAdminBundle\Entity\SkiRent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'skismilebundle_skirent';
    }


}
