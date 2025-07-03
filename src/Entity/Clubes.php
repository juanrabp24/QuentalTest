<?php

namespace App\Entity;

use App\Repository\ClubesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubesRepository::class)]
class Clubes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $estadio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $liga = null;

    #[ORM\Column(nullable: true)]
    private ?int $presupuesto = null;

    #[ORM\OneToMany(targetEntity: Jugadores::class, mappedBy: 'club')]
    private Collection $jugadores;

    #[ORM\OneToMany(targetEntity: Entrenadores::class, mappedBy: 'club')]
    private Collection $entrenadores;

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
        $this->entrenadores = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEstadio(): ?string
    {
        return $this->estadio;
    }

    public function setEstadio(?string $estadio): static
    {
        $this->estadio = $estadio;

        return $this;
    }

    public function getLiga(): ?string
    {
        return $this->liga;
    }

    public function setLiga(?string $liga): static
    {
        $this->liga = $liga;

        return $this;
    }

    public function getPresupuesto(): ?int
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(?int $presupuesto): static
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * @return Collection<int, Jugadores>
     */
    public function getJugadores(): Collection
    {
        return $this->jugadores;
    }

    public function addJugadore(Jugadores $jugadore): static
    {
        if (!$this->jugadores->contains($jugadore)) {
            $this->jugadores->add($jugadore);
            $jugadore->setClub($this);
        }

        return $this;
    }

    public function removeJugadore(Jugadores $jugadore): static
    {
        if ($this->jugadores->removeElement($jugadore)) {
            // set the owning side to null (unless already changed)
            if ($jugadore->getClub() === $this) {
                $jugadore->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entrenadores>
     */
    public function getEntrenadores(): Collection
    {
        return $this->entrenadores;
    }

    public function addEntrenadore(Entrenadores $entrenadore): static
    {
        if (!$this->entrenadores->contains($entrenadore)) {
            $this->entrenadores->add($entrenadore);
            $entrenadore->setClub($this);
        }

        return $this;
    }

    public function removeEntrenadore(Entrenadores $entrenadore): static
    {
        if ($this->entrenadores->removeElement($entrenadore)) {
            // set the owning side to null (unless already changed)
            if ($entrenadore->getClub() === $this) {
                $entrenadore->setClub(null);
            }
        }

        return $this;
    }

}
