<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class  Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("reclamations")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"numtel is required")]
    #[Groups("reclamations")]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("reclamations")]
    #[Assert\NotBlank(message:"numtel is required")]
    #[Assert\Email(message:"The email '{{ value }}' is not a valid email ")]
    private ?string $Mail = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups("reclamations")]
    //controle saisie date
    #[Assert\NotBlank(message:"numtel is required")]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("reclamations")]
    #[Assert\NotBlank(message:"numtel is required")]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'reclamation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $Types = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTypes(): ?Type
    {
        return $this->Types;
    }

    public function setTypes(?Type $Types): self
    {
        $this->Types = $Types;

        return $this;
    }
}
