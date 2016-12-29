<?php

namespace SkiSmileAdminBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', FileType::class, array(
                'label' => 'Зображення',
                'required'=> false
            ))
            ->add('name', TextType::class, array(
                'label' => 'Назва товару',
                'required'=> true
            ))
            ->add('price', null, array(
                'label' => 'Ціна',
                'required'=> true
            ))
            ->add('description', CKEditorType::class, array(
                'config' => array(
                    'toolbar' => 'full',
                    'uiColor' => "#26a69a"
                ),
                'label' => 'Характеристики',
                'required'=> true
            ))
            ->add('category', EntityType::class , array(
                'label' => 'Категорія',
                'class' => 'SkiSmileAdminBundle:ProductCategory',
                'choice_label' => 'name',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SkiSmileAdminBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'skismileadminbundle_product';
    }


}
