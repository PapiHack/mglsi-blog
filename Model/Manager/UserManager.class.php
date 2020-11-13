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
        $request = $this->db->prepare('INSERT INTO User (nom, prenom,
        mail, statut) VALUES(:nom, :prenom, :mail, :statut)');

        return $request->execute([
            'nom'    => $user->getNom(),
            'prenom' => $user->getPrenom(),
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
        $request = $this->db->prepare('UPDATE User SET nom = :nom, prenom = :prenom,
                         mail = :mail, statut = :statut WHERE id = :id');

        return $request->execute([
            'nom'    => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'mail'   => $user->getMail(),
            'statut' => $user->getStatut(),
            'id'     => $user->getId()
        ]);
    }

    public function pseudo_exist($login)
    {
        $url = explode('/', $_GET['url']);
        if($url[0] == 'updateUser')
        {
            $authManager = new AuthManager(Connexion::getConnexion());
            $auths = $authManager->getAll();
            $_auth = $authManager->get($url[1]);
            $pseudoExist = 0;

            foreach($auths as $auth)
            {
                if($auth->getLogin() == $login && $auth != $_auth)
                    $pseudoExist++;
            }
            return $pseudoExist;
        }

        $request = $this->db->prepare('SELECT * FROM Auth WHERE login = :login');
        $request->execute(['login' => $login]);

        return count($request->fetchAll());
    }

    public function mail_exist($mail)
    {
        $url = explode('/', $_GET['url']);
        if($url[0] == 'updateUser')
        {
            $users = $this->getAll();
            $_user = $this->get($url[1]);
            $mailExist = 0;

            foreach($users as $user)
            {
                if($user->getMail() == $mail && $user != $_user)
                    $mailExist++;
            }
            return $mailExist;
        }

        $request = $this->db->prepare('SELECT * FROM User WHERE mail = :mail');
        $request->execute(['mail' => $mail]);

        return count($request->fetchAll());
    }

    public function getAllMembres()
    {
        $users = array();

        $request = $this->db->query('SELECT * FROM User WHERE statut = \'user\'');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $users [] = new User($data);
        }

        return $users;
    }

    public function getAllAdmins()
    {
        $users = array();

        $request = $this->db->query('SELECT * FROM User WHERE statut = \'admin\' ');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $users [] = new User($data);
        }

        return $users;
    }

}
