<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImmobilierRepository")
 */
class Immobilier
{

    const TYPE = [
        0 => 'Autres',
        1 => 'Maison',
        2 => 'Appartement',
        3 => 'Terrain',
        4 => 'Parking'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_piece;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Property", inversedBy="immobilier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $property;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbPiece(): ?int
    {
        return $this->nb_piece;
    }

    public function setNbPiece(int $nb_piece): self
    {
        $this->nb_piece = $nb_piece;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }



    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $Property): self
    {
        $this->property = $Property;

        // set (or unset) the owning side of the relation if necessary
        $newImmobilier = $Property === null ? null : $this;
        if ($newImmobilier !== $Property->getImmobilier()) {
            $Property->setImmobilier($newImmobilier);
        }

        return $this;
    }
}
