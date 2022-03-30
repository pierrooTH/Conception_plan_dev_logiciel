<?php

namespace App\Entity;

use App\Repository\RiskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RiskRepository::class)
 */
class Risk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeOfRisk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $risk;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $probability;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $severity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $costRiskReduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meansDetection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $correctiveMeasures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfRisk(): ?string
    {
        return $this->typeOfRisk;
    }

    public function setTypeOfRisk(string $typeOfRisk): self
    {
        $this->typeOfRisk = $typeOfRisk;

        return $this;
    }

    public function getRisk(): ?string
    {
        return $this->risk;
    }

    public function setRisk(string $risk): self
    {
        $this->risk = $risk;

        return $this;
    }

    public function getProbability(): ?int
    {
        return $this->probability;
    }

    public function setProbability(?int $probability): self
    {
        $this->probability = $probability;

        return $this;
    }

    public function getSeverity(): ?int
    {
        return $this->severity;
    }

    public function setSeverity(?int $severity): self
    {
        $this->severity = $severity;

        return $this;
    }

    public function getCostRiskReduction(): ?string
    {
        return $this->costRiskReduction;
    }

    public function setCostRiskReduction(?string $costRiskReduction): self
    {
        $this->costRiskReduction = $costRiskReduction;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(?string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getMeansDetection(): ?string
    {
        return $this->meansDetection;
    }

    public function setMeansDetection(?string $meansDetection): self
    {
        $this->meansDetection = $meansDetection;

        return $this;
    }

    public function getCorrectiveMeasures(): ?string
    {
        return $this->correctiveMeasures;
    }

    public function setCorrectiveMeasures(?string $correctiveMeasures): self
    {
        $this->correctiveMeasures = $correctiveMeasures;

        return $this;
    }
}
