<?php

namespace App\Entity;

use App\Repository\ConseilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConseilRepository::class)]
class Conseil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Question is required")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Type of question is required")]
    private ?string $typecons = null;

    #[ORM\ManyToOne(inversedBy: 'conseils',cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeCons $typeCons = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypecons(): ?string
    {
        return $this->typecons;
    }

    public function setTypecons(string $typecons): self
    {
        $this->typecons = $typecons;

        return $this;
    }
    public function __toString()
    {
        return(string)$this->getTypecons();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
