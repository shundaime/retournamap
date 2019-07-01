<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email")
     */
    public function sendEmail(\Swift_Mailer $mailer)
    {
        $email = (new \Swift_Message('Hello Email'))
            ->setFrom('postmaster@sandbox947b10545abd41c8ad3b997d8e1cac52.mailgun.org')
            ->setTo('retournamap@gmail.com')
            ->setBody(
                '<p>Coucou</p>',
                'text/html'
            );

        $mailer->send($email);
        exit;
    }
}