<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Beelab\Recaptcha2Bundle\Form\Type\RecaptchaType;
use Beelab\Recaptcha2Bundle\Validator\Constraints\Recaptcha2;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('mail', EmailType::class)
            ->add('subject', TextType::class)
            ->add('content', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
            ->add('recaptcha', RecaptchaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}
