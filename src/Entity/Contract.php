<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Productor", inversedBy="contracts_name")
     */
    private $link;

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

    public function getLink(): ?Productor
    {
        return $this->link;
    }

    public function setLink(?Productor $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @var Productor
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Productor", inversedBy="contracts")
     * @ORM\JoinColumn(name="productor_id", referencedColumnName="id")
     */
    private $productor;
}
