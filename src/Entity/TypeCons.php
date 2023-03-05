<?php

namespace App\Entity;

use App\Repository\TypeConsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeConsRepository::class)]
class TypeCons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'typeCons', targetEntity: Conseil::class, orphanRemoval: true)]
    private Collection $conseils;

    public function __construct()
    {
        $this->conseils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Conseil>
     */
    public function getConseils(): Collection
    {
        return $this->conseils;
    }

    public function addConseil(Conseil $conseil): self
    {
        if (!$this->conseils->contains($conseil)) {
            $this->conseils->add($conseil);
            $conseil->setTypeCons($this);
        }

        return $this;
    }
/*
    public function removeConseil(Conseil $conseil): self
    {
        if ($this->conseils->removeElement($conseil)) {
            // set the owning side to null (unless already changed)
            if ($conseil->getTypeCons() === $this) {
                $conseil->setTypeCons(null);
            }
        }

        return $this;
    }*/
    public function __toString()
    {
        return(string)$this->getType();
    }
}
