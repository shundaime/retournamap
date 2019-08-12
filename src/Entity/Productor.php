<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductorRepository")
 */

class Productor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var UploadedFile
     * @Assert\NotBlank(groups={"new"})
     * @Assert\Image(
     *     mimeTypes={"image/jpeg", "image/png"},
     *     mimeTypesMessage="Merci d'enregistrer une image au format .jpg ou .png"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $delivery;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $label;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Contract", mappedBy="productor", cascade={"persist", "remove"})
     */
    private $contracts;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $image_description;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
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

    /**
     * @param Contract $contract
     * @return Productor
     */
    public function addContract(Contract $contract): Productor
    {
        $contract->setProductor($this);
        $this->contracts[] = $contract;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * @param Contract $contract
     * @return Productor
     */
    public function removeContract(Contract $contract): Productor
    {
        $this->contracts->removeElement($contract);

        return $this;
    }

    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    public function setDelivery(string $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getImageDescription(): ?string
    {
        return $this->image_description;
    }

    public function setImageDescription(string $image_description): self
    {
        $this->image_description = $image_description;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): Productor
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getImageFile(): ?UploadedFile
    {
        return $this->imageFile;
    }

    /**
     * @param UploadedFile $imageFile
     * @throws \Exception
     */
    public function setImageFile(?UploadedFile $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Productor
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getName();
    }
}
