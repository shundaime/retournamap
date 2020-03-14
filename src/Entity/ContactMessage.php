<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Beelab\Recaptcha2Bundle\Validator\Constraints\Recaptcha2;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactMessageRepository")
 */
class ContactMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     * @Assert\NotBlank()
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="20")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @Recaptcha2(message = "Impossible de vérifier que vous êtes un humain et non un robot.")
     * @var bool
     */
    private $recaptcha;

    /**
     * @Assert\File(
     *     maxSize = "10m",
     *     maxSizeMessage = "Votre fichier est trop volumineux, la taille maximum est de 10 Mo",
     *     mimeTypes = {"application/pdf", "application/doc", "application/jpg"},
     *     mimeTypesMessage = "Merci d'envoyer un fichier au format pdf, doc, ou jpg"
     * )
     */
    private $attachment;

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRecaptcha(): ?bool
    {
        return $this->recaptcha;
    }
    /**
     * @param bool $recaptcha
     * @return ContactMessage
     */
    public function setRecaptcha(?bool $recaptcha): ContactMessage
    {
        $this->recaptcha = $recaptcha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param mixed $attachment
     * @return ContactMessage
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }
}
