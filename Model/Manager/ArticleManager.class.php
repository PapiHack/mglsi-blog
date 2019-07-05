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

    public function getAll()
    {
        $articles = array();

        $request = $this->db->query('SELECT * FROM Article');

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
        $request = $this->db->prepare('UPDATE Article SET contenu = :contenu, categorie = :categorie, titre = :titre,
                                    dateModification = NOW() WHERE id = :id');
        
        return $request->execute([
            'titre'     => $article->getTitre(),
            'contenu'   => $article->getContenu(),
            'categorie' => $article->getCategorie(),
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