<?php

/**
 *
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 *
 *
 * Classe représentant le DAO d'un Article.
 *
 */
class ArticleManager
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getDb()
    {
        return $this->db;
    }

    private function setDb($db)
    {
        $this->db = $db;
    }

    public function add(Article $article)
    {
        $request = $this->db->prepare('INSERT INTO Article (titre, contenu, categorie,
        dateCreation, dateModification, auteur) VALUES(:titre, :contenu, :categorie, NOW(), NOW(), :auteur)');

        return $request->execute([
            'titre'     => $article->getTitre(),
            'contenu'   => $article->getContenu(),
            'categorie' => $article->getCategorie(),
            'auteur'    => $article->getAuteur()
        ]);
    }

    public function remove(Article $article)
    {
        return $this->db->exec('DELETE FROM Article WHERE id = '. $article->getId());
    }

    public function getPagination()
    {
        $articles = array();

        $request = $this->db->query('SELECT * FROM Article');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles [] = new Article($data);
        }

        $url = explode('/', $_GET['url']);
        $page = (empty($_GET['url'])) ? 1 : $page = $url[1];
        $nbre_total_articles = count($articles);
        $nbre_articles_par_page = 4;
        $last_page = ceil($nbre_total_articles / $nbre_articles_par_page);

        $page_num = $page;

        if($page_num < 1)
            $page_num = 1;
        else if($page_num > $last_page)
            $page_num = $last_page;

        $limit = 'LIMIT '.($page_num - 1) * $nbre_articles_par_page. ',' . $nbre_articles_par_page;

        $request = $this->db->query('SELECT * FROM Article ORDER BY dateCreation DESC '.$limit);
        $articles = array();

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles [] = new Article($data);
        }

        $pagination = '';
        if($last_page != 1)
        {
            if($page_num > 1)
            {
                $previous = $page_num - 1;
                $pagination .= '<a  class="btn btn-primary" href="'.URI.'page/'.$previous.'"><i class="fa fa-chevron-left"></i> Précédent</a> &nbsp; &nbsp;';
            }
            if($page_num != $last_page)
            {
                $next = $page_num + 1;
                $pagination .= '<a class="btn btn-primary" href="'.URI.'page/'.$next.'">Suivant <i class="fa fa-chevron-right"></i></a> ';
            }
        }

        return ['articles' => $articles, 'pagination' => $pagination];
    }

    public function getAll()
    {
        $request = $this->db->query('SELECT * FROM Article');
        $articles = array();

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles [] = new Article($data);
        }

        return $articles;
    }

    public function get($id)
    {
        $id = (int) $id;

        $request = $this->db->query('SELECT * FROM Article WHERE id = '.$id);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        $article = ($data === false) ? null : new Article($data);
        return $article;
    }

    public function update(Article $article)
    {
        $request = $this->db->prepare('UPDATE Article SET contenu = :contenu, categorie = :categorie, titre = :titre, dateModification = :dateM WHERE id = :id');

        return $request->execute([
            'titre'     => $article->getTitre(),
            'contenu'   => $article->getContenu(),
            'categorie' => $article->getCategorie(),
            'id'        => $article->getId(),
            'dateM'     => (new DateTime())->format('Y-m-d H:i:s'),
        ]);
    }

    public function getByCategory($category)
    {
        $articles = array();
        $category = (int) $category;

        $request = $this->db->prepare('SELECT * FROM Article WHERE categorie = :categorie');
        $request->execute(['categorie' => $category]);

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles [] = new Article($data);
        }

        return $articles;
    }

    public function getArticleByAuthor($author)
    {
        $articles = array();

        $request = $this->db->query('SELECT * FROM Article WHERE auteur = '. $author);

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles [] = new Article($data);
        }

        return $articles;
    }
}
