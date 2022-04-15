<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="taches")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Priorite::class, mappedBy="tache")
     */
    private $priorite;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->priorite = new ArrayCollection();
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

    /**
     * @return Collection<int, Priorite>
     */
    public function getPriorite(): Collection
    {
        return $this->priorite;
    }

    public function addPriorite(Priorite $priorite): self
    {
        if (!$this->priorite->contains($priorite)) {
            $this->priorite[] = $priorite;
            $priorite->setTache($this);
        }

        return $this;
    }

    public function removePriorite(Priorite $priorite): self
    {
        if ($this->priorite->removeElement($priorite)) {
            // set the owning side to null (unless already changed)
            if ($priorite->getTache() === $this) {
                $priorite->setTache(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
