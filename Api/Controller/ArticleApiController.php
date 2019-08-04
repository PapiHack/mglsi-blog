<?php

require_once('../Config/autoloader.php');

/**
 * 
 * @author P@piHack3R
 * @since 04/08/19
 * @version 1.0.0
 * 
 * Classe représentant le controller de l'API REST pour les requêtes concernant le model
 * Article.
 * 
 */
class ArticleApiController
{
    private $connexion;
    private $articleManager;
    private $userManager;
    private $categorieManager;

    public function __construct()
    {
        $this->connexion = Connexion::getConnexion();
        $this->articleManager = new ArticleManager($this->connexion);
        $this->userManager = new UserManager($this->connexion);
        $this->categorieManager = new CategorieManager($this->connexion);
    }

    public function get()
    {
        //header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();
        foreach($allArticles as $article)
        {
            $auteur = $this->userManager->get($article->getAuteur());
            $categorie = $this->categorieManager->get($article->getCategorie());
            var_dump($auteur, $categorie); die();
            $categ [] = [
                'id'      => $categorie->getId(),
                'libelle' => $categorie->getLibelle()
            ]; 

            $author [] = [
                'id'     => $auteur->getId(),
                'nom'    => $auteur->getNom(),
                'prenom' => $auteur->getPrenom(),
                'mail'   => $auteur->getMail(),
                'statut' => $auteur->getStatut()
            ];

            $articles [] = [
                'id'               => $article->getId(),
                'titre'            => $article->getTitre(),
                'contenu'          => $article->getContenu(),
                'dateCreation'     => $article->getDateCreation(),
                'dateModification' => $article->getDateModification(),
                'categorie'        => json_encode($categ),
                'auteur'           => json_encode($author)
            ];
        }
        echo json_encode($author);
    }

    public function getById($id)
    {
        header("Content-Type: application/json; charset=UTF-8");
        $article = $this->articleManager->get($id);
        $auteur = $this->userManager->get($article->getAuteur());
        $categorie = $this->categorieManager->get(getCategorie());

        $result [] = [
            'id'               => $article->getId(),
            'titre'            => $article->getTitre(),
            'contenu'          => $article->getContenu(),
            'dateCreation'     => $article->getDateCreation(),
            'dateModification' => $article->getDateModification(),
            'categorie'        => [
                'id'      => $categorie->getId(),
                'libelle' => $categorie->getLibelle()
            ],
            'auteur'           => [
                'id'     => $auteur->getId(),
                'nom'    => $auteur->getNom(),
                'prenom' => $auteur->getPrenom(),
                'mail'   => $auteur->getMail(),
                'statut' => $auteur->getStatut()
            ]
        ];
        echo json_encode($result);
    }

    public function getArticleByCategory($id)
    {
        header("Content-Type: application/json; charset=UTF-8");
        $articlesByCategorie = $this->articleManager->getByCategory($id);
        foreach($articlesByCategorie as $article)
        {
            $auteur = $this->userManager->get($article->getAuteur());
            $categorie = $this->categorieManager->get(getCategorie());

            $articles [] = [
                'id'               => $article->getId(),
                'titre'            => $article->getTitre(),
                'contenu'          => $article->getContenu(),
                'dateCreation'     => $article->getDateCreation(),
                'dateModification' => $article->getDateModification(),
                'categorie'        => [
                    'id'      => $categorie->getId(),
                    'libelle' => $categorie->getLibelle()
                ],
                'auteur'           => [
                    'id'     => $auteur->getId(),
                    'nom'    => $auteur->getNom(),
                    'prenom' => $auteur->getPrenom(),
                    'mail'   => $auteur->getMail(),
                    'statut' => $auteur->getStatut()
                ]
            ];
        }
        echo json_encode($articles);
    }

    public function getAllArticlesGroupByCategory()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();
        foreach($allArticles as $article)
        {
            $articles [] = [
                'id'               => $article->getId(),
                'titre'            => $article->getTitre(),
                'contenu'          => $article->getContenu(),
                'dateCreation'     => $article->getDateCreation(),
                'dateModification' => $article->getDateModification(),
                'categorie'        => $article->getCategorie(),
                'auteur'           => $article->getAuteur()
            ];
        }
        echo json_encode($articles);

    }

    private function groupByCategory($articles)
    {
        foreach($articles as $article)
        {
            $category = $article->getCategorie();
        }
    }
}