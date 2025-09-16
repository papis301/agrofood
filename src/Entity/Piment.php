<?php

namespace App\Entity;

use App\Repository\PimentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PimentRepository::class)]
class Piment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conditions_sol = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $besoins_eau = null;

    #[ORM\Column(length: 255)]
    private ?string $periode_semi = null;

    #[ORM\Column(length: 255)]
    private ?string $periode_recolte = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $techniques_entretien = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $maladies_communes = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $astuces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getConditionsSol(): ?string
    {
        return $this->conditions_sol;
    }

    public function setConditionsSol(string $conditions_sol): static
    {
        $this->conditions_sol = $conditions_sol;

        return $this;
    }

    public function getBesoinsEau(): ?string
    {
        return $this->besoins_eau;
    }

    public function setBesoinsEau(string $besoins_eau): static
    {
        $this->besoins_eau = $besoins_eau;

        return $this;
    }

    public function getPeriodeSemi(): ?string
    {
        return $this->periode_semi;
    }

    public function setPeriodeSemi(string $periode_semi): static
    {
        $this->periode_semi = $periode_semi;

        return $this;
    }

    public function getPeriodeRecolte(): ?string
    {
        return $this->periode_recolte;
    }

    public function setPeriodeRecolte(string $periode_recolte): static
    {
        $this->periode_recolte = $periode_recolte;

        return $this;
    }

    public function getTechniquesEntretien(): ?string
    {
        return $this->techniques_entretien;
    }

    public function setTechniquesEntretien(string $techniques_entretien): static
    {
        $this->techniques_entretien = $techniques_entretien;

        return $this;
    }

    public function getMaladiesCommunes(): ?string
    {
        return $this->maladies_communes;
    }

    public function setMaladiesCommunes(string $maladies_communes): static
    {
        $this->maladies_communes = $maladies_communes;

        return $this;
    }

    public function getAstuces(): ?string
    {
        return $this->astuces;
    }

    public function setAstuces(string $astuces): static
    {
        $this->astuces = $astuces;

        return $this;
    }
}
