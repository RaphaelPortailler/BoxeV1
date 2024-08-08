<?php

namespace App\Entity;

use App\Repository\CeintureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CeintureRepository::class)]
class Ceinture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Obtenir>
     */
    #[ORM\OneToMany(targetEntity: Obtenir::class, mappedBy: 'Ceinture')]
    private Collection $obtenirs;

    public function __construct()
    {
        $this->obtenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Obtenir>
     */
    public function getObtenirs(): Collection
    {
        return $this->obtenirs;
    }

    public function addObtenir(Obtenir $obtenir): static
    {
        if (!$this->obtenirs->contains($obtenir)) {
            $this->obtenirs->add($obtenir);
            $obtenir->setCeinture($this);
        }

        return $this;
    }

    public function removeObtenir(Obtenir $obtenir): static
    {
        if ($this->obtenirs->removeElement($obtenir)) {
            // set the owning side to null (unless already changed)
            if ($obtenir->getCeinture() === $this) {
                $obtenir->setCeinture(null);
            }
        }

        return $this;
    }
}
