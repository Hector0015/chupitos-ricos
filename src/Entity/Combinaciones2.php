<?php

namespace App\Entity;

use App\Repository\Combinaciones2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Combinaciones2Repository::class)]
class Combinaciones2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $alcoholes = null;

    #[ORM\Column(length: 255)]
    private ?string $mezclas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAlcoholes(): ?string
    {
        return $this->alcoholes;
    }

    public function setAlcoholes(string $alcoholes): static
    {
        $this->alcoholes = $alcoholes;

        return $this;
    }

    public function getMezclas(): ?string
    {
        return $this->mezclas;
    }

    public function setMezclas(string $mezclas): static
    {
        $this->mezclas = $mezclas;

        return $this;
    }
}
