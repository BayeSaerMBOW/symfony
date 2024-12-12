<?php

namespace App\Entity;

use App\Repository\AbsenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbsenceRepository::class)]
class Absence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAbs = null;

    #[ORM\ManyToOne(inversedBy: 'absences')]
    private ?Etudiant $relation = null;

    #[ORM\ManyToOne(inversedBy: 'absence')]
    private ?Etudiant $etudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAbs(): ?\DateTimeInterface
    {
        return $this->dateAbs;
    }

    public function setDateAbs(\DateTimeInterface $dateAbs): static
    {
        $this->dateAbs = $dateAbs;

        return $this;
    }

    public function getRelation(): ?Etudiant
    {
        return $this->relation;
    }

    public function setRelation(?Etudiant $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
