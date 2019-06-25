<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function new(Request $request)
    {
        $contact = new ContactMessage();
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class)
            ->add('mail', TextType::class)
            ->add('subject', TextType::class)
            ->add('content', TextType::class)
            ->add('send', SubmitType::class, ['label' => 'envoyer'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact.html.twig', [
            'form'=> $form->createView(),
        ]);
    }
}