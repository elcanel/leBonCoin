<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch {


    const CAT = [
        1 => 'Animaux',
        2 => 'Immobiliers',
        3 => 'Multimédia',
        4 => 'Véhicules',
        5 => 'Autres'
    ];


    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=0, max=6)
     */
    private $categorie;


    /**
     * @var Animaux|null
     */
    private $animaux;


    /**
     * @var Immobilier|null
     */
    private $immobilier;

    /**
     * @var Multimedia|null
     */
    private $multimedia;

    /**
     * @var Vehicules|null
     */
    private $vehicules;





    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    /**
     * @param int|null $categorie
     * @return PropertySearch
     */
    public function setCategorie(int $categorie): PropertySearch
    {
        $this->categorie = $categorie;
        return $this;
    }




    /**
     * @return Animaux|null
     */
    public function getAnimaux(): ?Animaux
    {
        return $this->animaux;
    }

    /**
     * @param Animaux|null $animaux
     * @return PropertySearch
     */
    public function setAnimaux(?Animaux $animaux): PropertySearch
    {
        $this->animaux = $animaux;
        return $this;
    }


    /**
     * @return Immobilier|null
     */
    public function getImmobilier(): ?Immobilier
    {
        return $this->immobilier;
    }

    /**
     * @param Immobilier|null $immobilier
     * @return PropertySearch
     */
    public function setImmobilier(?Immobilier $immobilier): PropertySearch
    {
        $this->immobilier = $immobilier;
        return $this;
    }


    /**
     * @return Multimedia|null
     */
    public function getMultimedia(): ?Multimedia
    {
        return $this->multimedia;
    }

    /**
     * @param Multimedia|null $multimedia
     * @return PropertySearch
     */
    public function setMultimedia(?Multimedia $multimedia): PropertySearch
    {
        $this->multimedia = $multimedia;
        return $this;
    }

    /**
     * @return Vehicules|null
     */
    public function getVehicules(): ?Vehicules
    {
        return $this->vehicules;
    }

    /**
     * @param Vehicules|null $vehicules
     * @return PropertySearch
     */
    public function setVehicules(?Vehicules $vehicules): PropertySearch
    {
        $this->vehicules = $vehicules;
        return $this;
    }



}