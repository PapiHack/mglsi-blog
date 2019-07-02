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
    private $auth;
    private $connexion;
    private $authManager;
    private $validationService;

    public function __construct()
    {
        $this->auth = true; 
        $this->connexion = Connexion::getConnexion();
        $this->authManager = new AuthManager($this->connexion);  
        $this->validationService = new Validation($this->authManager);
    }

    public function inscription()
    {
        require_once('../Views/Auth/inscription.php');
    }

    public function connexion()
    {
        require_once('../Views/Auth/connexion.php');
    }

    public function register()
    {
        var_dump($this->validationService->registerValidation($_POST)); die;
    }
}