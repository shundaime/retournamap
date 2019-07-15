<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use App\Form\ContactType;
use App\Service\EmailManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends PagesController
{
    /**
     * @Route("/contact", name="contact"))
     * @param Request $request
     * @param EmailManager $emailManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function new(Request $request, EmailManager $emailManager)
    {
        $contact = new ContactMessage();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $emailManager->sendContactMailToAdmin($contact);
            $this->addFlash('success', 'Votre email a été envoyé');

            return $this->redirectToRoute('contact');
        }
        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}