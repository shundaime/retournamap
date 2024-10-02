<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractRepository")
 * @Vich\Uploadable
 */
class Contract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="contracts_directory", fileNameProperty="filename")
     * @var File
     * @Assert\File(
     *     mimeTypes={"application/pdf", "image/webp", "image/png", "image/jpeg"},
     *     mimeTypesMessage="Merci d'enregistrer un fichier au format pdf, jpg, png ou webp"
     * )
     */
    private $pdfFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Productor
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Productor", inversedBy="contracts")
     * @ORM\JoinColumn(name="productor_id", referencedColumnName="id")
     */
    private $productor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;


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

    public function getProductor(): ?Productor
    {
        return $this->productor;
    }

    public function setProductor(?Productor $productor): self
    {
        $this->productor = $productor;
        return $this;
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
     * @return Contract
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     * @return Contract
     */
    public function setFileName($fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getPdfFile()
    {
        return $this->pdfFile;
    }

    public function setPdfFile(File $pdfFile = null)
    {
        $this->pdfFile = $pdfFile;
        if ($pdfFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function __toString(): ?string
    {
        return $this->getName();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
