<?php

namespace SkiSmileAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use SkiSmileAdminBundle\Entity\FotoGallery;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FotoGalleryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place', ChoiceType::class, array(
                'label' => 'Виберіть місце',
                'choices' => FotoGallery::$places,
                'required' => true,
            ))
            ->add('imageFile', FileType::class, array (
                'required' => false
            ))
            ->add('description', null, array(
                'label' => 'Опис',
                'required' => false
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SkiSmileAdminBundle\Entity\FotoGallery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'skismileadminbundle_fotogallery';
    }


}
