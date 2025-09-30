<?php

namespace App\Entity;

use App\Repository\AnimalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalsRepository::class)]
class Animals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $img = null;

    #[ORM\ManyToOne]
    private ?Type $type_id = null;

    #[ORM\ManyToOne]
    private ?Genre $genre_id = null;

    /**
     * @var Collection<int, Reviews>
     */
    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'animals')]
    private Collection $review;

    public function __construct()
    {
        $this->review = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }


    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->type_id;
    }

    public function setTypeId(?Type $type_id): static
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getGenreId(): ?Genre
    {
        return $this->genre_id;
    }

    public function setGenreId(?Genre $genre_id): static
    {
        $this->genre_id = $genre_id;

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Reviews $review): static
    {
        if (!$this->review->contains($review)) {
            $this->review->add($review);
            $review->setAnimals($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): static
    {
        if ($this->review->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getAnimals() === $this) {
                $review->setAnimals(null);
            }
        }

        return $this;
    }
}
