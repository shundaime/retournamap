<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends PagesController
{
    /**
     * @Route("/contact", name="contact"))
     */

    public function new(Request $request)
    {
        $contact = new ContactMessage();
        $form = $this->createFormBuilder($contact)
            ->setAction($this->generateUrl('contact'))
            ->setMethod('POST')
            ->add('name', TextType::class)
            ->add('mail', EmailType::class)
            ->add('subject', TextType::class)
            ->add('content', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
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
            'form' => $form->createView(),
        ]);
    }
}