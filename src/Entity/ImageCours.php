<?php

namespace App\Entity;

use App\Repository\ImageCoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageCoursRepository::class)]
/**
 * @Vich\Uploadable
 */
class ImageCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'imageCours', targetEntity: Formation::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $formation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $imageFile;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatesAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(Formation $formation): self
    {
        $this->formation = $formation;

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

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile($imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getUpdatesAt(): ?\DateTimeInterface
    {
        return $this->updatesAt;
    }

    public function setUpdatesAt(?\DateTimeInterface $updatesAt): self
    {
        $this->updatesAt = $updatesAt;

        return $this;
    }

    
}
