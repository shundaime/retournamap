<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends PagesController
{
    /**
     * @Route("/contact", name="contact"))
     */

    public function new(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new ContactMessage();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /*$contact = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();*/
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('postmaster@sandbox947b10545abd41c8ad3b997d8e1cac52.mailgun.org')
                ->setTo('retournamap@gmail.com')
                ->setBody('coucou')
            ;
            dump($mailer->send($message)); exit;
            $this->addFlash('success', 'Votre email a été envoyé');

            return $this->redirectToRoute('contact');
        }
        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}