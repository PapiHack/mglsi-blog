<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * 
 * Classe représentant le DAO d'une Catégorie.
 * 
 */
class CategorieManager 
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

    public function add(Categorie $categorie)
    {
        $request = $this->db->prepare('INSERT INTO Categorie (id, libelle) VALUES(:id, :libelle)');
        
        return $request->execute([
            'id'      => '',
            'libelle' => $categorie->getLibelle()
        ]);
    }

    public function remove(Categorie $categorie)
    {
        return $this->db->exec('DELETE FROM Categorie WHERE id = '. $categorie->getId());
    }

    public function getAll()
    {
        $categories = array();

        $request = $this->db->query('SELECT * FROM Categorie');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $categories [] = new Categorie($data);
        }

        return $categories;
    }

    public function get($id)
    {
        $id = (int) $id;

        $request = $this->db->query('SELECT * FROM Categorie WHERE id = '.$id);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        return new Categorie($data);
    }

    public function update(Categorie $categorie)
    {
        $request = $this->db->prepare('UPDATE Categorie SET libelle = :libelle WHERE id = :id');

        return $request->execute([
            'libelle' => $categorie->getLibelle(),
            'id'      => $categorie->getId()
        ]);
    }

    public function categorie_exist($libelle)
    {
        $request = $this->db->prepare('SELECT * FROM Categorie WHERE libelle = :libelle');
        $request->execute(['libelle' => $libelle]);

        return count($request->fetchAll());
    }
}