<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 */

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe Représentant les informations d'Authentification d'un User.
 * 
 */
class Auth 
{
    use HydratationTrait;

    private $id;
    private $idUser;
    private $login;
    private $mdp;

    public function __construct(Array $data)
    {
        $this->hydrate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->$idUser = $idUser;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->$login = $login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }
}