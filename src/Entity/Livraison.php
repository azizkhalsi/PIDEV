<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use App\Form\LivraisonType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups("livraisons")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Groups("livraisons")]
    #[Assert\Length(min:2 , minMessage : "quantité doit contenir au moins 10 Kg")]
    #[Assert\NotBlank(message:"quantite is required")]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
    #[Groups("livraisons")]
    #[ORM\JoinColumn(nullable: false)]
    private ?string $etat = null;
    


    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $types = null;

    #[ORM\OneToMany(mappedBy: 'livraison', targetEntity: User::class)]
    private Collection $userAdresse;

    public function __construct()
    {
        $this->userAdresse = new ArrayCollection();
    }


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

    public function getTypes(): ?Type
    {
        return $this->types;
    }

    public function setTypes(?Type $types): self
    {
        $this->types = $types;

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getAdresse();
    }
    
    /**
     * @return Collection<int, User>
     */
    public function getUserAdresse(): Collection
    {
        return $this->userAdresse;
    }

    public function addUserAdresse(User $userAdresse): self
    {
        if (!$this->userAdresse->contains($userAdresse)) {
            $this->userAdresse->add($userAdresse);
            $userAdresse->setLivraison($this);
        }

        return $this;
    }

    public function removeUserAdresse(User $userAdresse): self
    {
        if ($this->userAdresse->removeElement($userAdresse)) {
            // set the owning side to null (unless already changed)
            if ($userAdresse->getLivraison() === $this) {
                $userAdresse->setLivraison(null);
            }
        }

        return $this;
    }
  
   
}
