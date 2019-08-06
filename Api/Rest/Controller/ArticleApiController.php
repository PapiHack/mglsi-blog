<?php
// require_once('../vendor/autoload.php');
//
// use OpenApi\Annotations as OA;

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

    public function displayApiDocumentation()
    {
        header('Location: '.WEBROOT.'apidoc/index.html');
    }

    /**
     * @OA\Get(
     *      path="/articles",
     *      tags={"article"},
     *      @OA\Parameter(
     *          name="dataType",
     *          in="query",
     *          description="Permet de spécifier le format de données (xml/json) que va retourner la requête. S'il n'est pas spécifier ce sera du JSON par défaut.",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Nos articles disponibles",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"), @OA\Xml(name="article")),
     *          @OA\XmlContent(type="array", @OA\Xml(name="articles", wrapped=true), @OA\Items(ref="#/components/schemas/Article"))
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Article non trouvé",
     *          @OA\JsonContent(type="string"),
     *          @OA\XmlContent(type="string")
     *      )
     * )
     *
     */
    public function get($type = null)
    {

        $dataType = $type != null ? $type : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();

        if(empty($allArticles))
            return $dataType == 'xml' ? $this->generate_xml_from_array(['message' => 'Aucun article trouvé !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

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

    /**
     * @OA\Get(
     *      path="/articles/{id}",
     *      tags={"article"},
     *      @OA\Parameter(
     *          name="dataType",
     *          in="query",
     *          description="Permet de spécifier le format de données (xml/json) que va retourner la requête. S'il n'est pas spécifier ce sera du JSON par défaut.",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Permet de spécifier l'id de la ressource.",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="L'article en question.",
     *          @OA\JsonContent(ref="#/components/schemas/Article"),
     *          @OA\XmlContent(ref="#/components/schemas/Article")
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Article non trouvé",
     *          @OA\JsonContent(type="string"),
     *          @OA\XmlContent(type="string")
     *      )
     * )
     */
    public function getById($id,$type = null)
    {
        $dataType = $type != null ? $type : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $article = $this->articleManager->get($id);

        if($article == null)
            return $dataType == 'xml' ? $this->generate_xml_from_array(['message' => 'Cet article n\'existe pas !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

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

    /**
     * @OA\Get(
     *      path="/articles/categorie/{id}",
     *      tags={"article"},
     *      @OA\Parameter(
     *          name="dataType",
     *          in="query",
     *          description="Permet de spécifier le format de données (xml/json) que va retourner la requête. S'il n'est pas spécifier ce sera du JSON par défaut.",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Permet de spécifier l'id de la catégorie dont on veut récuperer les articles.",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Les articles correspondant à la catégorie spécifier.",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"), @OA\Xml(name="article")),
     *          @OA\XmlContent(type="array", @OA\Xml(name="articles", wrapped=true), @OA\Items(ref="#/components/schemas/Article"))
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Article non trouvé",
     *          @OA\JsonContent(type="string"),
     *          @OA\XmlContent(type="string")
     *      )
     * )
     */
    public function getArticleByCategory($id,$type = null)
    {
        $dataType = $type != null ? $type : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $articlesByCategorie = $this->articleManager->getByCategory($id);

        if(empty($articlesByCategorie))
            return $dataType == 'xml' ? $this->generate_xml_from_array(['message' => 'Aucun article trouvé pour cette catégorie !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

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

    /**
     * @OA\Get(
     *      path="/articlesByCategory",
     *      tags={"article"},
     *      @OA\Parameter(
     *          name="dataType",
     *          in="query",
     *          description="Permet de spécifier le format de données (xml/json) que va retourner la requête. S'il n'est pas spécifier ce sera du JSON par défaut.",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Nos articles disponibles regroupés par catégorie.",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"), @OA\Xml(name="article")),
     *          @OA\XmlContent(type="array", @OA\Xml(name="articles", wrapped=true), @OA\Items(ref="#/components/schemas/Article"))
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Article non trouvé",
     *          @OA\JsonContent(type="string"),
     *          @OA\XmlContent(type="string")
     *      )
     * )
     */
    public function getAllArticlesGroupByCategory($type = null)
    {
        $dataType = $type != null ? $type : 'json';
        $dataType == 'xml' ? header("Content-Type: application/xml; charset=UTF-8") : header("Content-Type: application/json; charset=UTF-8");
        $allArticles = $this->articleManager->getAll();

        if(empty($allArticles))
            return $dataType == 'xml' ? $this->generate_xml_from_array(['message' => 'Aucun article trouvé !'], 'message') : json_encode(['message' => 'Cet article n\'existe pas !']);

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
