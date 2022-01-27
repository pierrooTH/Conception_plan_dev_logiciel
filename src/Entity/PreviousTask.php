<?php

namespace App\Entity;

use App\Repository\PreviousTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PreviousTaskRepository::class)
 */
class PreviousTask
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $letter;

    /**
     * @ORM\ManyToOne(targetEntity=Tache::class, inversedBy="Id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_task;

    public function __construct()
    {
        $this->id_tache = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): self
    {
        $this->letter = $letter;

        return $this;
    }

    public function getIdTask(): ?Tache
    {
        return $this->id_task;
    }

    public function setIdTask(?Tache $id_task): self
    {
        $this->id_task = $id_task;

        return $this;
    }

}
