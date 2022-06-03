<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\ManyToOne(targetEntity: Langage::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $langage;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private $auteur;

   

    #[ORM\Column(type: 'text')]
    private $chapeau;

    #[ORM\Column(type: 'text')]
    private $corps;

    #[ORM\Column(type: 'text')]
    private $resume;

    #[ORM\Column(type: 'string', nullable: true)]
    private $image;

    #[ORM\Column(type: 'boolean')]
    private $isSignaled;

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

    public function getLangage(): ?Langage
    {
        return $this->langage;
    }

    public function setLangage(?Langage $langage): self
    {
        $this->langage = $langage;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getChapeau(): ?string
    {
        return $this->chapeau;
    }

    public function setChapeau(string $chapeau): self
    {
        $this->chapeau = $chapeau;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): self
    {
        $this->corps = $corps;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getIsSignaled(): ?bool
    {
        return $this->isSignaled;
    }

    public function setIsSignaled(bool $isSignaled): self
    {
        $this->isSignaled = $isSignaled;

        return $this;
    }

}
