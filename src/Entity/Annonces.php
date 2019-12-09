<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Annonces
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sold;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\admin", inversedBy="Property")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\animaux", inversedBy="Property", cascade={"persist", "remove"})
     */
    private $animaux;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\immobilier", inversedBy="Property", cascade={"persist", "remove"})
     */
    private $immobilier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\multimedia", inversedBy="Property", cascade={"persist", "remove"})
     */
    private $multimedia;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\vehicules", inversedBy="Property", cascade={"persist", "remove"})
     */
    private $vehiculies;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getUser(): ?admin
    {
        return $this->user;
    }

    public function setUser(?admin $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCat(): ?int
    {
        return $this->cat;
    }

    public function setCat(?int $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    public function getAnimaux(): ?animaux
    {
        return $this->animaux;
    }

    public function setAnimaux(?animaux $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getImmobilier(): ?immobilier
    {
        return $this->immobilier;
    }

    public function setImmobilier(?immobilier $immobilier): self
    {
        $this->immobilier = $immobilier;

        return $this;
    }

    public function getMultimedia(): ?multimedia
    {
        return $this->multimedia;
    }

    public function setMultimedia(?multimedia $multimedia): self
    {
        $this->multimedia = $multimedia;

        return $this;
    }

    public function getVehiculies(): ?vehicules
    {
        return $this->vehiculies;
    }

    public function setVehiculies(?vehicules $vehiculies): self
    {
        $this->vehiculies = $vehiculies;

        return $this;
    }
}
