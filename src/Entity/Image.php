<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_image = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacement_image = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boxeur $Boxeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleImage(): ?string
    {
        return $this->libelle_image;
    }

    public function setLibelleImage(string $libelle_image): static
    {
        $this->libelle_image = $libelle_image;

        return $this;
    }

    public function getEmplacementImage(): ?string
    {
        return $this->emplacement_image;
    }

    public function setEmplacementImage(string $emplacement_image): static
    {
        $this->emplacement_image = $emplacement_image;

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
}
