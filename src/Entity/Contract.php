<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractRepository")
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
     */
    private $name;

    /**
     * @var UploadedFile
     * @Assert\NotBlank()
     * @Assert\File(
     *     mimeTypes={"application/pdf"},
     *     mimeTypesMessage="Merci d'enregistrer un fichier au format .pdf"
     * )
     */
    private $pdfFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Productor
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Productor", inversedBy="contracts")
     * @ORM\JoinColumn(name="productor_id", referencedColumnName="id")
     */
    private $productor;


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

    public function getContract(): ?Productor
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
     * @return UploadedFile
     */
    public function getPdfFile(): ?UploadedFile
    {
        return $this->pdfFile;

    }

    /**
     * @param UploadedFile $pdfFile
     * @return Contract
     * @throws \Exception
     */
    public function setPdfFile(?UploadedFile $pdfFile): Contract
    {
        $this->pdfFile = $pdfFile;
        if ($this->pdfFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     * @return Contract
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }
}
