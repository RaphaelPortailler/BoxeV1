<?php

namespace App\Entity;

use App\Repository\ObtenirRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObtenirRepository::class)]
class Obtenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_obtention = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_perte = null;

    #[ORM\ManyToOne(inversedBy: 'obtenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boxeur $Boxeur = null;

    #[ORM\ManyToOne(inversedBy: 'obtenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ceinture $Ceinture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->Date_obtention;
    }

    public function setDateObtention(\DateTimeInterface $Date_obtention): static
    {
        $this->Date_obtention = $Date_obtention;

        return $this;
    }

    public function getDatePerte(): ?\DateTimeInterface
    {
        return $this->Date_perte;
    }

    public function setDatePerte(?\DateTimeInterface $Date_perte): static
    {
        $this->Date_perte = $Date_perte;

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

    public function getCeinture(): ?Ceinture
    {
        return $this->Ceinture;
    }

    public function setCeinture(?Ceinture $Ceinture): static
    {
        $this->Ceinture = $Ceinture;

        return $this;
    }
}
