<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{

    const CAT = [
        1 => 'Animaux',
        2 => 'Immobiliers',
        3 => 'Multimédia',
        4 => 'Véhicules',
        5 => 'Autres'
    ];

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * * @Assert\Length( max=7)
     * * @Assert\Range(min=0)
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
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Animaux", mappedBy="Property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $animaux;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Immobilier", mappedBy="Property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $immobilier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Multimedia", mappedBy="Property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $multimedia;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vehicules", mappedBy="Property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $vehicules;


    public function __construct()
    {
        $this->createdAt = new \DateTime();

    }

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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
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

    public function getFormatedPrice(): string
    {
        return number_format($this->prix, 0, '', ' ');
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

    public function getAnimaux(): ?Animaux
    {
        return $this->animaux;
    }

    public function setAnimaux(?Animaux $animaux): self
    {
        $this->animaux = $animaux;

        // set (or unset) the owning side of the relation if necessary
        $newProperty = $animaux === null ? null : $this;
        if ($newProperty !== $animaux->getProperty()) {
            $animaux->setProperty($newProperty);
        }

        return $this;
    }

    public function getImmobilier(): ?Immobilier
    {
        return $this->immobilier;
    }

    public function setImmobilier(?Immobilier $immobilier): self
    {
        $this->immobilier = $immobilier;

        // set (or unset) the owning side of the relation if necessary
        $newProperty = $immobilier === null ? null : $this;
        if ($newProperty !== $immobilier->getProperty()) {
            $immobilier->setProperty($newProperty);
        }

        return $this;
    }

    public function getMultimedia(): ?Multimedia
    {
        return $this->multimedia;
    }

    public function setMultimedia(?Multimedia $multimedia): self
    {
        $this->multimedia = $multimedia;

        // set (or unset) the owning side of the relation if necessary
        $newProperty = $multimedia === null ? null : $this;
        if ($newProperty !== $multimedia->getProperty()) {
            $multimedia->setProperty($newProperty);
        }

        return $this;
    }

    public function getVehicules(): ?Vehicules
    {
        return $this->vehicules;
    }

    public function setVehicules(?Vehicules $vehicules): self
    {
        $this->vehicules = $vehicules;

        // set (or unset) the owning side of the relation if necessary
        $newProperty = $vehicules === null ? null : $this;
        if ($newProperty !== $vehicules->getProperty()) {
            $vehicules->setProperty($newProperty);
        }

        return $this;
    }



}
