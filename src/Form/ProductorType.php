<?php

namespace App\Form;

use App\Entity\Productor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture',TextType::class)
            ->add('delivery',TextType::class)
            ->add('label',TextType::class)
            ->add('image_description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Productor::class,
            'translation_domain' => 'forms'
        ]);
    }
}
