<?php

namespace App\Entity;

use App\Repository\PratiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PratiqueRepository::class)]
class Pratique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_fin = null;

    #[ORM\ManyToOne(inversedBy: 'pratiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boxeur $Boxeur = null;

    #[ORM\ManyToOne(inversedBy: 'pratiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeBoxe $Type_boxe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->Date_debut;
    }

    public function setDateDebut(\DateTimeInterface $Date_debut): static
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(?\DateTimeInterface $Date_fin): static
    {
        $this->Date_fin = $Date_fin;

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

    public function getTypeBoxe(): ?TypeBoxe
    {
        return $this->Type_boxe;
    }

    public function setTypeBoxe(?TypeBoxe $Type_boxe): static
    {
        $this->Type_boxe = $Type_boxe;

        return $this;
    }
}
