<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use App\Form\ContactType;
use App\Service\EmailManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact", methods={"GET"})
     * @param Request $request
     * @param EmailManager $emailManager
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function new(Request $request, EmailManager $emailManager, EntityManagerInterface $entityManager) : Response
    {
        $contact = new ContactMessage();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
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