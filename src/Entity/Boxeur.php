<?php

namespace App\Entity;

use App\Repository\BoxeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoxeurRepository::class)]
class Boxeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Pseudo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_naissance = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Activite = null;

    #[ORM\Column]
    private ?int $Victoire = null;

    #[ORM\Column]
    private ?int $Defaite = null;

    #[ORM\Column]
    private ?int $Egalite = null;

    /**
     * @var Collection<int, Pratique>
     */
    #[ORM\OneToMany(targetEntity: Pratique::class, mappedBy: 'Boxeur')]
    private Collection $pratiques;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'Boxeur')]
    private Collection $images;

    /**
     * @var Collection<int, Obtenir>
     */
    #[ORM\OneToMany(targetEntity: Obtenir::class, mappedBy: 'Boxeur')]
    private Collection $obtenirs;

    /**
     * @var Collection<int, Peser>
     */
    #[ORM\OneToMany(targetEntity: Peser::class, mappedBy: 'Boxeur')]
    private Collection $pesers;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'Boxeur')]
    private Collection $commentaires;


    public function __construct()
    {
        $this->pratiques = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->obtenirs = new ArrayCollection();
        $this->pesers = new ArrayCollection();
        $this->commentaires = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(?string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->Date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $Date_naissance): static
    {
        $this->Date_naissance = $Date_naissance;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->Activite;
    }

    public function setActivite(string $Activite): static
    {
        $this->Activite = $Activite;

        return $this;
    }

    public function getVictoire(): ?int
    {
        return $this->Victoire;
    }

    public function setVictoire(int $Victoire): static
    {
        $this->Victoire = $Victoire;

        return $this;
    }

    public function getDefaite(): ?int
    {
        return $this->Defaite;
    }

    public function setDefaite(int $Defaite): static
    {
        $this->Defaite = $Defaite;

        return $this;
    }

    public function getEgalite(): ?int
    {
        return $this->Egalite;
    }

    public function setEgalite(int $Egalite): static
    {
        $this->Egalite = $Egalite;

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
            $pratique->setBoxeur($this);
        }

        return $this;
    }

    public function removePratique(Pratique $pratique): static
    {
        if ($this->pratiques->removeElement($pratique)) {
            // set the owning side to null (unless already changed)
            if ($pratique->getBoxeur() === $this) {
                $pratique->setBoxeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setBoxeur($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getBoxeur() === $this) {
                $image->setBoxeur(null);
            }
        }

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
            $obtenir->setBoxeur($this);
        }

        return $this;
    }

    public function removeObtenir(Obtenir $obtenir): static
    {
        if ($this->obtenirs->removeElement($obtenir)) {
            // set the owning side to null (unless already changed)
            if ($obtenir->getBoxeur() === $this) {
                $obtenir->setBoxeur(null);
            }
        }

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
            $peser->setBoxeur($this);
        }

        return $this;
    }

    public function removePeser(Peser $peser): static
    {
        if ($this->pesers->removeElement($peser)) {
            // set the owning side to null (unless already changed)
            if ($peser->getBoxeur() === $this) {
                $peser->setBoxeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setBoxeur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBoxeur() === $this) {
                $commentaire->setBoxeur(null);
            }
        }

        return $this;
    }

}
