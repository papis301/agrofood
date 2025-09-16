<?php

namespace App\Entity;

use App\Repository\CultureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CultureRepository::class)]
class Culture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $conditionsSol = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $besoinsEau = null;

    #[ORM\Column(length: 255)]
    private ?string $periodeSemi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $periodeRecolte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $techniquesEntretien = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $maladiesCommunes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $astuces = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getConditionsSol(): ?string
    {
        return $this->conditionsSol;
    }

    public function setConditionsSol(?string $conditionsSol): static
    {
        $this->conditionsSol = $conditionsSol;

        return $this;
    }

    public function getBesoinsEau(): ?string
    {
        return $this->besoinsEau;
    }

    public function setBesoinsEau(?string $besoinsEau): static
    {
        $this->besoinsEau = $besoinsEau;

        return $this;
    }

    public function getPeriodeSemi(): ?string
    {
        return $this->periodeSemi;
    }

    public function setPeriodeSemi(string $periodeSemi): static
    {
        $this->periodeSemi = $periodeSemi;

        return $this;
    }

    public function getPeriodeRecolte(): ?string
    {
        return $this->periodeRecolte;
    }

    public function setPeriodeRecolte(?string $periodeRecolte): static
    {
        $this->periodeRecolte = $periodeRecolte;

        return $this;
    }

    public function getTechniquesEntretien(): ?string
    {
        return $this->techniquesEntretien;
    }

    public function setTechniquesEntretien(?string $techniquesEntretien): static
    {
        $this->techniquesEntretien = $techniquesEntretien;

        return $this;
    }

    public function getMaladiesCommunes(): ?string
    {
        return $this->maladiesCommunes;
    }

    public function setMaladiesCommunes(?string $maladiesCommunes): static
    {
        $this->maladiesCommunes = $maladiesCommunes;

        return $this;
    }

    public function getAstuces(): ?string
    {
        return $this->astuces;
    }

    public function setAstuces(?string $astuces): static
    {
        $this->astuces = $astuces;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
