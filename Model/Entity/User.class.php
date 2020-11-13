<?php
/**
 * 
 * @author P@piHack3R
 * @since 02/07/19
 * @version 1.0.0
 * 
 */

//require_once('../../Api/vendor/autoload.php');

use OpenApi\Annotations as OA;

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe représentant un User.
 * @OA\Schema()
 */
class User 
{
    use HydratationTrait;

    /**
     * @OA\Property(type="integer", description="L'identifiant de la l'utilisateur")
     *
     * @var int
     */
    private $id;
    
    /**
     * @OA\Property(type="string", description="Nom de l'utilisateur")
     *
     * @var String
     */
    private $nom;
    
    /**
     * @OA\Property(type="string", description="Prénom de l'utilisateur")
     *
     * @var String
     */
    private $prenom;
    
    /**
     * @OA\Property(type="string", description="Adresse email de l'utilisateur")
     *
     * @var String
     */
    private $mail;
    
    /**
     * @OA\Property(type="string", description="Statut de l'utilisateur")
     *
     * @var String
     */
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
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
}