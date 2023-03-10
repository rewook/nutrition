<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $tempsPrepa = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsRepos = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsCuisson = null;

    #[ORM\ManyToMany(targetEntity: Etape::class, inversedBy: 'recettes')]
    private Collection $etape ;

    #[ORM\ManyToMany(targetEntity: Allergene::class, inversedBy: 'recettes')]
    private Collection $allergene;

    #[ORM\ManyToMany(targetEntity: Regime::class, inversedBy: 'recettes')]
    private Collection $regime;

    #[ORM\Column]
    private ?bool $public = null;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Avis::class, orphanRemoval: true)]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: IngredientRecette::class, orphanRemoval: true)]
    private Collection $ingredientRecettes;



    public function __construct()
    {
        $this->allergene = new ArrayCollection();
        $this->regime = new ArrayCollection();
        $this->etape = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->ingredientRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTempsPrepa(): ?int
    {
        return $this->tempsPrepa;
    }

    public function setTempsPrepa(int $tempsPrepa): self
    {
        $this->tempsPrepa = $tempsPrepa;

        return $this;
    }

    public function getTempsRepos(): ?int
    {
        return $this->tempsRepos;
    }

    public function setTempsRepos(?int $tempsRepos): self
    {
        $this->tempsRepos = $tempsRepos;

        return $this;
    }

    public function getTempsCuisson(): ?int
    {
        return $this->tempsCuisson;
    }

    public function setTempsCuisson(?int $tempsCuisson): self
    {
        $this->tempsCuisson = $tempsCuisson;

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtape(): Collection
    {
        return $this->etape;
    }

    /**
     * @return Collection<int, Allergene>
     */
    public function getAllergene(): Collection
    {
        return $this->allergene;
    }

    public function addAllergene(Allergene $allergene): self
    {
        if (!$this->allergene->contains($allergene)) {
            $this->allergene->add($allergene);
        }

        return $this;
    }

    public function removeAllergene(Allergene $allergene): self
    {
        $this->allergene->removeElement($allergene);

        return $this;
    }

    /**
     * @return Collection<int, Regime>
     */
    public function getRegime(): Collection
    {
        return $this->regime;
    }

    public function addRegime(Regime $regime): self
    {
        if (!$this->regime->contains($regime)) {
            $this->regime->add($regime);
        }

        return $this;
    }

    public function removeRegime(Regime $regime): self
    {
        $this->regime->removeElement($regime);

        return $this;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etape->contains($etape)) {
            $this->etape->add($etape);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        $this->etape->removeElement($etape);

        return $this;
    }

    public function isPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setRecette($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getRecette() === $this) {
                $avi->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, IngredientRecette>
     */
    public function getIngredientRecettes(): Collection
    {
        return $this->ingredientRecettes;
    }

    public function addIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if (!$this->ingredientRecettes->contains($ingredientRecette)) {
            $this->ingredientRecettes->add($ingredientRecette);
            $ingredientRecette->setRecette($this);
        }

        return $this;
    }

    public function removeIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if ($this->ingredientRecettes->removeElement($ingredientRecette)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecette->getRecette() === $this) {
                $ingredientRecette->setRecette(null);
            }
        }

        return $this;
    }


}
