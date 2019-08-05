<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 */

//require_once('../../Api/vendor/autoload.php');

use OpenApi\Annotations as OA;

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe représentant un Article.
 * @OA\Schema()
 */
class Article 
{
    use HydratationTrait;

    /**
     * @OA\Property(type="integer", description="L'identifiant de l'article")
     *
     * @var int
     */
    private $id;
    
    /**
     * @OA\Property(type="string", description="Titre de l'article")
     *
     * @var String
     */
    private $titre;
    
    /**
     * @OA\Property(type="string", description="Contenu de l'article")
     *
     * @var String
     */   
    private $contenu;
    
    /**
     * @OA\Property(type="string", format="date-time", description="Date de création de l'article")
     *
     * @var \DateTime
     */   
    private $dateCreation;
    
    /**
     * @OA\Property(type="string", format="date-time", description="Date de modification de l'article")
     *
     * @var \DateTime
     */     
    private $dateModification;
    
    /**
     * @OA\Property(description="Catégorie de l'article", 
     *              ref="#/components/schemas/Categorie"
     * )
     *
     * @var int
     */   
    private $categorie;
    
    /**
     * @OA\Property(description="Auteur de l'article", 
     *              ref="#/components/schemas/User"
     * )
     *
     * @var int
     */ 
    private $auteur;

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

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }
}