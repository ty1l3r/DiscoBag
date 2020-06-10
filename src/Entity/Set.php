<?php

namespace App\Entity;

use App\Repository\SetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SetRepository::class)
 * @ORM\Table(name="`set`")
 */
class Set
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sets")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $setName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mixCom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $setCom;

    /**
     * @ORM\ManyToMany(targetEntity=Track::class, inversedBy="sets")
     */
    private $list;

    public function __construct()
    {
        $this->list = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSetName(): ?string
    {
        return $this->setName;
    }

    public function setSetName(string $setName): self
    {
        $this->setName = $setName;

        return $this;
    }

    public function getMixCom(): ?string
    {
        return $this->mixCom;
    }

    public function setMixCom(?string $mixCom): self
    {
        $this->mixCom = $mixCom;

        return $this;
    }

    public function getSetCom(): ?string
    {
        return $this->setCom;
    }

    public function setSetCom(?string $setCom): self
    {
        $this->setCom = $setCom;

        return $this;
    }

    /**
     * @return Collection|Track[]
     */
    public function getList(): Collection
    {
        return $this->list;
    }

    public function addList(Track $list): self
    {
        if (!$this->list->contains($list)) {
            $this->list[] = $list;
        }

        return $this;
    }

    public function removeList(Track $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
        }

        return $this;
    }
}