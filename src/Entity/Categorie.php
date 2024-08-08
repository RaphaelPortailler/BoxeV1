<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_categorie = null;

    /**
     * @var Collection<int, Peser>
     */
    #[ORM\OneToMany(targetEntity: Peser::class, mappedBy: 'Categorie')]
    private Collection $pesers;

    public function __construct()
    {
        $this->pesers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->libelle_categorie;
    }

    public function setLibelleCategorie(string $libelle_categorie): static
    {
        $this->libelle_categorie = $libelle_categorie;

        return $this;
    }

    /**
     * @return Collection<int, Peser>
     */
    public function getPesers(): Collection
    {
        return $this->pesers;
    }

    public function addPeser(Peser $peser): static
    {
        if (!$this->pesers->contains($peser)) {
            $this->pesers->add($peser);
            $peser->setCategorie($this);
        }

        return $this;
    }

    public function removePeser(Peser $peser): static
    {
        if ($this->pesers->removeElement($peser)) {
            // set the owning side to null (unless already changed)
            if ($peser->getCategorie() === $this) {
                $peser->setCategorie(null);
            }
        }

        return $this;
    }
}
