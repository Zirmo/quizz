<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?theme $theme = null;

    #[ORM\ManyToMany(targetEntity: Reponse::class, inversedBy: 'questions')]
    private Collection $reponse;

    public function __construct()
    {
        $this->reponse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTheme(): ?theme
    {
        return $this->theme;
    }

    public function setTheme(?theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, reponse>
     */
    public function getReponse(): Collection
    {
        return $this->reponse;
    }

    public function addReponse(reponse $reponse): self
    {
        if (!$this->reponse->contains($reponse)) {
            $this->reponse->add($reponse);
        }

        return $this;
    }

    public function removeReponse(reponse $reponse): self
    {
        $this->reponse->removeElement($reponse);

        return $this;
    }
}