<?php

namespace App\Entity;

use App\Repository\PeserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeserRepository::class)]
class Peser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Poids = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_poids = null;

    #[ORM\ManyToOne(inversedBy: 'pesers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boxeur $Boxeur = null;

    #[ORM\ManyToOne(inversedBy: 'pesers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $Categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoids(): ?int
    {
        return $this->Poids;
    }

    public function setPoids(int $Poids): static
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getDatePoids(): ?\DateTimeInterface
    {
        return $this->Date_poids;
    }

    public function setDatePoids(\DateTimeInterface $Date_poids): static
    {
        $this->Date_poids = $Date_poids;

        return $this;
    }

    public function getBoxeur(): ?Boxeur
    {
        return $this->Boxeur;
    }

    public function setBoxeur(?Boxeur $Boxeur): static
    {
        $this->Boxeur = $Boxeur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }
}
