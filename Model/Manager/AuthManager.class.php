<?php

 require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * 
 * Classe Représentant le DAO d'un Auth.
 * 
 */
class AuthManager
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

    public function add(Auth $auth)
    {
        $request = $this->db->prepare('INSERT INTO Auth (idUser, login, mdp) VALUES(:idUser, :login, :mdp)');
        
        return $request->execute([
            'idUser' => $auth->getIdUser(),
            'login'  => $auth->getLogin(),
            'mdp'    => $auth->getMdp()
        ]);
    }

    public function remove(Auth $auth)
    {
        return $this->db->exec('DELETE FROM Auth WHERE id = '. $auth->getId());
    }

    public function getAll()
    {
        $auths = array();

        $request = $this->db->query('SELECT * FROM Auth');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $auths [] = new Auth($data);
        }

        return $auths;
    }

    public function get($id)
    {
        $id = (int) $id;

        $request = $this->db->query('SELECT * FROM Auth WHERE id = '.$id);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        return new Auth($data);
    }

    public function update(Auth $auth)
    {
        $request = $this->db->prepare('UPDATE Auth SET idUser = :idUser, login = :login, mdp = :mdp WHERE id = :id');

        return $request->execute([
            'idUser' => $auth->getIdUser(),
            'login'  => $auth->getLogin(),
            'mdp'    => $auth->getMdp()
        ]);
    }
    
    public function getUserAuthenticated($userId)
    {
        $userId = (int) $userId;

        $request = $this->db->query('SELECT * FROM User WHERE id = '.$userId);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        return new User($data);
    }

    public function tryAuth($login, $mdp)
    {
        $request = $this->db->prepare('SELECT * FROM Auth WHERE login = :login and mdp = :mdp');
        $request->execute([
            'login' => $login,
            'mdp'   => $mdp
        ]);
        
        return count($request->fetchAll());
    }

    public function getAuth($login, $mdp)
    {
        $request = $this->db->prepare('SELECT * FROM Auth WHERE login = :login and mdp = :mdp');
        $request->execute([
            'login' => $login,
            'mdp'   => $mdp
        ]);

        return new Auth($request->fetch(PDO::FETCH_ASSOC));

    }

}