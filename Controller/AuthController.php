<?php

require_once('../Config/autoloader.php');

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Classe représentant le controller de tout ce qui est authentification.
 * 
 */
class AuthController 
{
    private $connexion;
    private $authManager;
    private $auth;

    public function __construct()
    {
        $this->auth = true; 
        $this->connexion = Connexion::getConnexion();
        $this->authManager = new AuthManager($this->connexion);  
    }

    public function inscription()
    {
        require_once('../Views/Auth/inscription.php');
    }

    public function connexion()
    {
        require_once('../Views/Auth/connexion.php');
    }
}