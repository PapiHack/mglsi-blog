<?php
 
 require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * 
 * Classe Représentant le DAO d'un User.
 * 
 */
class UserManager
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

    public function add(User $user)
    {
        $request = $this->db->prepare('INSERT INTO User (nom, prenom, pseudo,
        mail, statut) VALUES(:nom, :prenom, :pseudo, :mail, :statut)');
                    
        return $request->execute([
            'nom'    => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'pseudo' => $user->getPseudo(),
            'mail'   => $user->getMail(),
            'statut' => $user->getStatut()
        ]);
    }

    public function remove(User $user)
    {
        return $this->db->exec('DELETE FROM User WHERE id = '. $user->getId());
    }

    public function getAll()
    {
        $users = array();

        $request = $this->db->query('SELECT * FROM User');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $users [] = new User($data);
        }
        
        return $users;
    }

    public function get($id)
    {
        $id = (int) $id;

        $request = $this->db->query('SELECT * FROM User WHERE id = '.$id);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        $user = ($data === false) ? null : new User($data);
        return $user;
    }

    public function update(User $user)
    {
        $request = $this->db->prepare('UPDATE User SET nom = : nom, prenom = :prenom, 
                            pseudo = :pseudo, mail = :mail, statut = :statut');
        
        return $request->execute([
            'nom'    => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'pseudo' => $user->getPseudo(),
            'mail'   => $user->getMail(),
            'statut' => $user->getStatut()
        ]);
    }

    public function pseudo_exist($pseudo)
    {
        $request = $this->db->prepare('SELECT * FROM User WHERE pseudo = :pseudo');
        $request->execute(['pseudo' => $pseudo]);

        return count($request->fetchAll());
    }

    public function mail_exist($mail)
    {
        $request = $this->db->prepare('SELECT * FROM User WHERE mail = :mail');
        $request->execute(['mail' => $mail]);

        return count($request->fetchAll());
    }

}