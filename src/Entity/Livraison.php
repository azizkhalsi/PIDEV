<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Assert\Length(min:2 , minMessage : "quantité doit contenir au moins 10 Kg")]
    #[Assert\NotBlank(message:"quantite is required")]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
   #[ORM\JoinColumn(nullable: false)]
    private ?string $etat = null;
    


    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categories = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEtat(): ?string
    { 
        return $this->etat;
        
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;
       

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
