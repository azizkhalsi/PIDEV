<?php

namespace App\Entity;

use App\Repository\TypeReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TypeReclamationRepository::class)]
class TypeReclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Type is required")]

    private ?string $typereclamation = null;

    #[ORM\OneToMany(mappedBy: 'typeReclamations', targetEntity: Reclamation::class, orphanRemoval: true)]

    private Collection $reclamations;

    public function __construct()
    {
        $this->reclamations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypereclamation(): ?string
    {
        return $this->typereclamation;
    }

    public function setTypereclamation(string $typereclamation): self
    {
        $this->typereclamation = $typereclamation;

        return $this;
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): Self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations->add($reclamation);
            $reclamation->setTypeReclamations($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getTypeReclamations() === $this) {
                $reclamation->setTypeReclamations(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getTypereclamation();
    }

}



