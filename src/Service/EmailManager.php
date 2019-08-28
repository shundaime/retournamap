<?php

namespace App\Service;

use App\Entity\ContactMessage;
use Mailgun\Mailgun;
use Twig\Environment;

class EmailManager
{
    /** @var Environment */
    private $twig;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $domain;

    /** @var string */
    private $endpoint;

    /** @var string */
    private $sender;

    /** @var string */
    private $recipient;

    /**
     * EmailManager constructor.
     *
     * @param Environment $twig
     * @param string $apiKey
     * @param string $domain
     * @param string $endpoint
     * @param string $sender
     * @param string $recipient
     */
    public function __construct(Environment $twig, $apiKey, $domain, $endpoint, $sender, $recipient)
    {
        $this->twig = $twig;
        $this->apiKey = $apiKey;
        $this->domain = $domain;
        $this->endpoint = $endpoint;
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    /**
     * @param ContactMessage $contactMessage
     * @Twig
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendContactMailToAdmin(ContactMessage $contactMessage)
    {
        if($contactMessage->getAttachment() !== null){
            $message = Mailgun::create($this->apiKey, $this->endpoint);
            $message->messages()->send($this->domain, [
                'from' => $this->sender,
                'to' => $this->recipient,
                'subject' => 'Nouveau message depuis le site',
                'html' => $this->twig->render('emails/contact.html.twig', [
                    'message' => $contactMessage,
                ]),
                'attachment' => [
                    [
                        'fileContent' => file_get_contents($contactMessage->getAttachment()->getPathname()),
                        'filename' => $contactMessage->getAttachment()->getClientOriginalName()
                    ]
                ]
            ]);
        } else {
            $message = Mailgun::create($this->apiKey, $this->endpoint);
            $message->messages()->send($this->domain, [
                'from' => $this->sender,
                'to' => $this->recipient,
                'subject' => 'Nouveau message depuis le site',
                'html' => $this->twig->render('emails/contact.html.twig', [
                    'message' => $contactMessage,
                ])
            ]);
        }
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return EmailManager
     */
    public function setApiKey(string $apiKey): EmailManager
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return EmailManager
     */
    public function setDomain(string $domain): EmailManager
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @return EmailManager
     */
    public function setEndpoint(string $endpoint): EmailManager
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     * @return EmailManager
     */
    public function setSender(string $sender): EmailManager
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return EmailManager
     */
    public function setRecipient(string $recipient): EmailManager
    {
        $this->recipient = $recipient;
        return $this;
    }
}