<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Location::class)]
    private Collection $Loacations;

    public function __construct()
    {
        $this->Loacations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLoacations(): Collection
    {
        return $this->Loacations;
    }

    public function addLoacation(Location $loacation): static
    {
        if (!$this->Loacations->contains($loacation)) {
            $this->Loacations->add($loacation);
            $loacation->setClient($this);
        }

        return $this;
    }

    public function removeLoacation(Location $loacation): static
    {
        if ($this->Loacations->removeElement($loacation)) {
            // set the owning side to null (unless already changed)
            if ($loacation->getClient() === $this) {
                $loacation->setClient(null);
            }
        }

        return $this;
    }
}
