<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimauxRepository")
 */
class Animaux
{
    const TYPE = [
        0 => 'Autres',
        1 => 'Chat',
        2 => 'Chien',
        3 => 'Rongeur',
        4 => 'Oiseau',
        5 => 'Reptile'
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
     * @ORM\OneToOne(targetEntity="App\Entity\Property", inversedBy="animaux", cascade={"persist", "remove"})
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



    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $Property): self
    {
        $this->Property = $Property;

        // set (or unset) the owning side of the relation if necessary
        $newAnimaux = $Property === null ? null : $this;
        if ($newAnimaux !== $Property->getAnimaux()) {
            $Property->setAnimaux($newAnimaux);
        }

        return $this;
    }


}
