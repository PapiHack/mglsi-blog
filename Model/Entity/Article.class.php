<?php
/**
 * 
 * @author P@piHack3R
 * @version 1.0.0
 * 
 */

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe représentant un Article.
 * 
 */
class Article 
{
    use HydratationTrait;

    private $id;   
    private $titre;   
    private $contenu;   
    private $dateCreation;   
    private $dateModification;
    private $categorie;

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
        $this->id = (int) $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($date)
    {
        $this->dateCreation = $date;
    }

    public function getDateModification()
    {
        return $this->dateModification;
    }

    public function setDateModification($date)
    {
        $this->dateModification = $date;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}