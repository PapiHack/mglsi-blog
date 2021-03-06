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
    private $userManager;

    public function __construct()
    {
        SessionManager::start();
        $this->connexion = Connexion::getConnexion();
        $this->userManager = new UserManager($this->connexion);
        $this->articleManager = new ArticleManager($this->connexion);
        $this->categorieManager = new CategorieManager($this->connexion);
        $this->allArticles = $this->articleManager->getPagination()['articles'];
        $this->pagination = $this->articleManager->getPagination()['pagination'];
        $this->allCategories = $this->categorieManager->getAll();
    }

    public function index()
    {
        require_once('../Views/blog/index.php');
    }

    public function articleByCategory($id)
    {
        $this->allArticles = $this->articleManager->getByCategory($id);
        require_once('../Views/blog/index.php');
    }

    public function articleById($id)
    {
        $article = $this->articleManager->get($id);
        require_once('../Views/blog/article.php');
    }
}
