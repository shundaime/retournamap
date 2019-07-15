<?php

namespace App\Form;

use App\Entity\Productor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('imageFile',FileType::class, [
                'label' => 'Picture',
                'required' => false,
            ])
            ->add('contracts',  CollectionType::class, [
                'entry_type' => ContractType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('delivery',TextType::class)
            ->add('label',ChoiceType::class, [
                'choices' => ['Bio' => 'bio.png',
                'Nature & Progrès' => 'nature.png',
                'Ecocert' => 'ecocert.jpg']
            ])
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
