<?php
/**
 * 
 * @author P@piHack3R
 * @since 02/07/19
 * @version 1.0.0
 * 
 */

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe représentant un User.
 * 
 */
class User 
{
    use HydratationTrait;

    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $mail;
    private $statut;

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

    public function getNom()
    {
        $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->nom = $prenom;
    }

    public function getPseudo()
    {
        $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getMail()
    {
        $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getStatut()
    {
        $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
}