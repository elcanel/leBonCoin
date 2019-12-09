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




    //Variables animaux

    /**
     * @var int|null
     */
    private $type_anim;



    //Variables immo


    /**
     * @var int|null
     */
    private $type_immo;

    /**
     * @var int|null
     */
    private $surface_immo;

    /**
     * @var int|null
     */
    private $nb_piece_immo;




    //Variable multi


    /**
     * @var int|null
     */
    private $type_multi;


    /**
     * @var string|null
     */
    private $marque_multi;




    //Variables véhicules


    /**
     * @var int|null
     */
    private $type_vehi;

    /**
     * @var int|null
     */
    private $nb_km_vehi;

    /**
     * @var string|null
     */
    private $energie_vehi;

    /**
     * @var int|null
     */
    private $annee_vehi;

















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







    /**
     * @return int|null
     */
    public function getTypeAnim(): ?int
    {
        return $this->type_anim;
    }

    /**
     * @param int|null $type_anim
     * @return PropertySearch
     */
    public function setTypeAnim(?int $type_anim): PropertySearch
    {
        $this->type_anim = $type_anim;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTypeImmo(): ?int
    {
        return $this->type_immo;
    }

    /**
     * @param int|null $type_immo
     * @return PropertySearch
     */
    public function setTypeImmo(?int $type_immo): PropertySearch
    {
        $this->type_immo = $type_immo;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfaceImmo(): ?int
    {
        return $this->surface_immo;
    }

    /**
     * @param int|null $surface_immo
     * @return PropertySearch
     */
    public function setSurfaceImmo(?int $surface_immo): PropertySearch
    {
        $this->surface_immo = $surface_immo;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbPieceImmo(): ?int
    {
        return $this->nb_piece_immo;
    }

    /**
     * @param int|null $nb_piece_immo
     * @return PropertySearch
     */
    public function setNbPieceImmo(?int $nb_piece_immo): PropertySearch
    {
        $this->nb_piece_immo = $nb_piece_immo;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTypeMulti(): ?int
    {
        return $this->type_multi;
    }

    /**
     * @param int|null $type_multi
     * @return PropertySearch
     */
    public function setTypeMulti(?int $type_multi): PropertySearch
    {
        $this->type_multi = $type_multi;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMarqueMulti(): ?string
    {
        return $this->marque_multi;
    }

    /**
     * @param string|null $marque_multi
     * @return PropertySearch
     */
    public function setMarqueMulti(?string $marque_multi): PropertySearch
    {
        $this->marque_multi = $marque_multi;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTypeVehi(): ?int
    {
        return $this->type_vehi;
    }

    /**
     * @param int|null $type_vehi
     * @return PropertySearch
     */
    public function setTypeVehi(?int $type_vehi): PropertySearch
    {
        $this->type_vehi = $type_vehi;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbKmVehi(): ?int
    {
        return $this->nb_km_vehi;
    }

    /**
     * @param int|null $nb_km_vehi
     * @return PropertySearch
     */
    public function setNbKmVehi(?int $nb_km_vehi): PropertySearch
    {
        $this->nb_km_vehi = $nb_km_vehi;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEnergieVehi(): ?string
    {
        return $this->energie_vehi;
    }

    /**
     * @param string|null $energie_vehi
     * @return PropertySearch
     */
    public function setEnergieVehi(?string $energie_vehi): PropertySearch
    {
        $this->energie_vehi = $energie_vehi;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAnneeVehi(): ?int
    {
        return $this->annee_vehi;
    }

    /**
     * @param int|null $annee_vehi
     * @return PropertySearch
     */
    public function setAnneeVehi(?int $annee_vehi): PropertySearch
    {
        $this->annee_vehi = $annee_vehi;
        return $this;
    }



}