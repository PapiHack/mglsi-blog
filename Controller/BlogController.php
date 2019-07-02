<?php

require_once('../Config/autoloader.php');

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Classe représentant le controller du blog et comportant des méthodes qui représentent 
 * des actions en fonction de la requête du user.
 * 
 */
class BlogController
{
    private $connexion;
    private $articleManager;
    private $categorieManager;
    private $allArticles;
    private $allCategories;

    public function __construct()
    {
        $this->connexion = Connexion::getConnexion();
        $this->articleManager = new ArticleManager($this->connexion);
        $this->categorieManager = new CategorieManager($this->connexion);
        $this->allArticles = $this->articleManager->getAll();
        $this->allCategories = $this->categorieManager->getAll();
    }

    public function index()
    {
        require_once('../Views/blog/index.php');
    }

    public function articleByCategory()
    {
        $this->allArticles = $this->articleManager->getByCategory($_GET['categorie']);
        require_once('../Views/blog/index.php');
    }

    public function article()
    {
        $article = $this->articleManager->get($_GET['id']);
        require_once('../Views/blog/article.php');
    }
}