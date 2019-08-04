<?php

require_once('../Config/autoloader.php');

/**
 * 
 * @author P@piHack3R
 * @since 04/08/19
 * @version 1.0.0
 * 
 * Classe représentant le controller de l'API REST pour les requêtes concernant le model Article.
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
        $dataType = isset($_GET['dataType']) ? $_GET['dataType'] : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();

        if(empty($allArticles))
            return $dataType == 'xml' ? $this->generate_valid_xml_from_array(['message' => 'Aucun article trouvé !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

        foreach($allArticles as $article)
        {
            $auteur = $this->userManager->get($article->getAuteur());
            $categorie = $this->categorieManager->get($article->getCategorie());

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
        return $dataType == 'xml' ? $this->generate_valid_xml_from_array($articles, 'articles', 'article') : json_encode($articles);
    }

    public function getById($id)
    {
        $dataType = isset($_GET['dataType']) ? $_GET['dataType'] : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $article = $this->articleManager->get($id);

        if($article == null)
            return $dataType == 'xml' ? $this->generate_valid_xml_from_array(['message' => 'Cet article n\'existe pas !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

        $auteur = $this->userManager->get($article->getAuteur());
        $categorie = $this->categorieManager->get($article->getCategorie());

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
        return $dataType == 'xml' ? $this->generate_xml_from_array($result, 'article') : json_encode($result);
    }

    public function getArticleByCategory($id)
    {
        $dataType = isset($_GET['dataType']) ? $_GET['dataType'] : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $articlesByCategorie = $this->articleManager->getByCategory($id);

        if(empty($articlesByCategorie))
            return $dataType == 'xml' ? $this->generate_valid_xml_from_array(['message' => 'Aucun article trouvé pour cette catégorie !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

        foreach($articlesByCategorie as $article)
        {
            $auteur = $this->userManager->get($article->getAuteur());
            $categorie = $this->categorieManager->get($article->getCategorie());

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
        return $dataType == 'xml' ? $this->generate_valid_xml_from_array($articles, 'articles', 'article') : json_encode($articles);
    }

    public function getAllArticlesGroupByCategory()
    {
        $dataType = isset($_GET['dataType']) ? $_GET['dataType'] : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();

        if(empty($allArticles))
            return $dataType == 'xml' ? $this->generate_valid_xml_from_array(['message' => 'Aucun article trouvé !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);
            
        return $dataType == 'xml' ? $this->generate_valid_xml_from_array($this->groupByCategory($allArticles), 'articles', 'article') : json_encode($this->groupByCategory($allArticles));
    }

    private function groupByCategory($articles)
    {
        $allCategory = $this->categorieManager->getAll();

        foreach($allCategory as $categorie)
        {
            $articles = $this->articleManager->getByCategory($categorie->getId());
            if(!empty($articles))
                $articlesByCategory [] = $articles;
        }

        for($i = 0; $i < count($articlesByCategory) ; $i++)
        {
            foreach($articlesByCategory[$i] as $article)
            {
                $auteur = $this->userManager->get($article->getAuteur());
                $categorie = $this->categorieManager->get($article->getCategorie());

                $all [] = [
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

        }
        return $all;
    }

    private function generate_xml_from_array($array, $node_name) 
    {
        $xml = '';
    
        if (is_array($array) || is_object($array)) 
        {
            foreach ($array as $key => $value) 
            {
                if (is_numeric($key)) 
                {
                    $key = $node_name;
                }
    
                $xml .= '<' . $key . '>' . "\n" . $this->generate_xml_from_array($value, $node_name) . '</' . $key . '>' . "\n";
            }
        } 
        else 
        {
            $xml = htmlspecialchars($array, ENT_QUOTES) . "\n";
        }
    
        return $xml;
    }
    
    private function generate_valid_xml_from_array($array, $node_block='nodes', $node_name='node') 
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
    
        $xml .= '<' . $node_block . '>' . "\n";
        $xml .= $this->generate_xml_from_array($array, $node_name);
        $xml .= '</' . $node_block . '>' . "\n";
    
        return $xml;
    }
}