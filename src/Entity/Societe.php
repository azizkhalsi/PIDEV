<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups("societes")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("societes")]
    #[Assert\NotBlank(message:"adresse is required")]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Groups("societes")]
    #[Assert\NotBlank(message:"nomdesociete is required")]
    private ?string $nomdesociete = null;

    #[ORM\Column(length: 255)]
    #[Groups("societes")]
    #[Assert\NotBlank(message:"numtel is required")]
    private ?string $numtel = null;

    #[ORM\ManyToOne(inversedBy: 'Societes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categories = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnumtel(): ?string
    {
        return $this->numtel;
    }

    public function getadresse(): ?string
    {
        return $this->adresse;
    }

    public function getnomdesociete(): ?string
    {
        return $this->nomdesociete;
    }

   

    public function setnumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }
    public function setadresse(String $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function setnomdesociete(string $nomdesociete): self
    {
        $this->nomdesociete = $nomdesociete;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
  
   
}
