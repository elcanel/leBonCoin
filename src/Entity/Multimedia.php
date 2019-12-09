<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MultimediaRepository")
 */
class Multimedia
{

    const TYPE = [
        0 => 'Autres',
        1 => 'Ordinateur',
        2 => 'Television',
        3 => 'Telephone',
        4 => 'CD/DVD',
        5 => 'Consoles'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Property", inversedBy="multimedia", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $property;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

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
        $newMultimedia = $Property === null ? null : $this;
        if ($newMultimedia !== $Property->getMultimedia()) {
            $Property->setMultimedia($newMultimedia);
        }

        return $this;
    }
}
