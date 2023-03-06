<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $typeSociete = null;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Societe::class, orphanRemoval: true)]

    private Collection $Societes;

    public function __construct()
    {
        $this->Societes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSociete(): ?string
    {
        return $this->typeSociete;
    }

    public function setTypeSociete(string $typeSociete): self
    {
        $this->typeSociete = $typeSociete;

        return $this;
    }

    /**
     * @return Collection<int, Societe>
     */
    public function getSocietes(): Collection
    {
        return $this->Societes;
    }

    public function addSociete(Societe $Societe): self
    {
        if (!$this->Societes->contains($Societe)) {
            $this->Societes->add($Societe);
            $Societe->setCategories($this);
        }

        return $this;
    }

    public function removeSociete(Societe $Societe): self
    {
        if ($this->Societes->removeElement($Societe)) {
            // set the owning side to null (unless already changed)
            if ($Societe->getCategories() === $this) {
                $Societe->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getTypeSociete();
    }

}



