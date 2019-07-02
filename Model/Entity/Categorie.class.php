<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 */

require_once('../Utilities/HydratationTrait.php');

/**
 * Classe Représentant une Catégorie.
 * 
 */
class Categorie 
{
    use HydratationTrait;

    private $id;
    private $libelle;

    public function __construct(Array $data)
    {
        $this->hydrate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}