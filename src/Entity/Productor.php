<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductorRepository")
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="productors_directory", fileNameProperty="filename")
     * @var File
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

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $filename = null)
    {
        $this->imageFile = $filename;
        if ($filename) {
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
