<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculesRepository")
 */
class Vehicules
{

    const TYPE = [
        0 => 'Autres',
        1 => 'Voiture',
        2 => 'Moto',
        3 => 'Camion',
        4 => 'Quad',
        5 => 'Caravane',
        6 => 'Bateau'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_km;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $energie;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Property", inversedBy="vehicules", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $property;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbKm(): ?int
    {
        return $this->nb_km;
    }

    public function setNbKm(int $nb_km): self
    {
        $this->nb_km = $nb_km;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

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
        $newVehicules = $Property === null ? null : $this;
        if ($newVehicules !== $Property->getVehicules()) {
            $Property->setVehicules($newVehicules);
        }

        return $this;
    }
}
