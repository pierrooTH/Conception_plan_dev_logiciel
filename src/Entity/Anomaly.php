<?php

namespace App\Entity;

use App\Repository\AnomalyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnomalyRepository::class)
 */
class Anomaly
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
    private $webPageLocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $scenario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebPageLocation(): ?string
    {
        return $this->webPageLocation;
    }

    public function setWebPageLocation(string $webPageLocation): self
    {
        $this->webPageLocation = $webPageLocation;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getScenario(): ?string
    {
        return $this->scenario;
    }

    public function setScenario(?string $scenario): self
    {
        $this->scenario = $scenario;

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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}
