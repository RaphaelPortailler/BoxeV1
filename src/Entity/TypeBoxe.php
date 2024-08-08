<?php

namespace App\Entity;

use App\Repository\TypeBoxeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeBoxeRepository::class)]
class TypeBoxe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle_type_boxe = null;

    /**
     * @var Collection<int, Pratique>
     */
    #[ORM\OneToMany(targetEntity: Pratique::class, mappedBy: 'Type_boxe')]
    private Collection $pratiques;

    public function __construct()
    {
        $this->pratiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleTypeBoxe(): ?string
    {
        return $this->Libelle_type_boxe;
    }

    public function setLibelleTypeBoxe(string $Libelle_type_boxe): static
    {
        $this->Libelle_type_boxe = $Libelle_type_boxe;

        return $this;
    }

    /**
     * @return Collection<int, Pratique>
     */
    public function getPratiques(): Collection
    {
        return $this->pratiques;
    }

    public function addPratique(Pratique $pratique): static
    {
        if (!$this->pratiques->contains($pratique)) {
            $this->pratiques->add($pratique);
            $pratique->setTypeBoxe($this);
        }

        return $this;
    }

    public function removePratique(Pratique $pratique): static
    {
        if ($this->pratiques->removeElement($pratique)) {
            // set the owning side to null (unless already changed)
            if ($pratique->getTypeBoxe() === $this) {
                $pratique->setTypeBoxe(null);
            }
        }

        return $this;
    }
}
