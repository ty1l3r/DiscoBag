<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrackRepository::class)
 * @ApiResource()
 */
class Track
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, inversedBy="tracks")
     */
    private $artistes;

    /**
     * @ORM\Column(type="time")
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $face;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tone;

    /**
     * @ORM\ManyToMany(targetEntity=Disk::class, mappedBy="tracks")
     */
    private $disks;

    /**
     * @ORM\ManyToMany(targetEntity=Set::class, mappedBy="list")
     */
    private $sets;

    public function __construct()
    {
        $this->artistes = new ArrayCollection();
        $this->disks = new ArrayCollection();
        $this->sets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artist $artiste): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
        }

        return $this;
    }

    public function removeArtiste(Artist $artiste): self
    {
        if ($this->artistes->contains($artiste)) {
            $this->artistes->removeElement($artiste);
        }

        return $this;
    }

    public function getLength(): ?\DateTimeInterface
    {
        return $this->length;
    }

    public function setLength(\DateTimeInterface $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getFace(): ?string
    {
        return $this->face;
    }

    public function setFace(string $face): self
    {
        $this->face = $face;

        return $this;
    }

    public function getTone(): ?string
    {
        return $this->tone;
    }

    public function setTone(?string $tone): self
    {
        $this->tone = $tone;

        return $this;
    }

    /**
     * @return Collection|Disk[]
     */
    public function getDisks(): Collection
    {
        return $this->disks;
    }

    public function addDisk(Disk $disk): self
    {
        if (!$this->disks->contains($disk)) {
            $this->disks[] = $disk;
            $disk->addTrack($this);
        }

        return $this;
    }

    public function removeDisk(Disk $disk): self
    {
        if ($this->disks->contains($disk)) {
            $this->disks->removeElement($disk);
            $disk->removeTrack($this);
        }

        return $this;
    }

    /**
     * @return Collection|Set[]
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(Set $set): self
    {
        if (!$this->sets->contains($set)) {
            $this->sets[] = $set;
            $set->addList($this);
        }

        return $this;
    }

    public function removeSet(Set $set): self
    {
        if ($this->sets->contains($set)) {
            $this->sets->removeElement($set);
            $set->removeList($this);
        }

        return $this;
    }
}
