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
    private $userManager;
    private $validationService;

    public function __construct()
    {
        $this->auth = true; 
        $this->connexion = Connexion::getConnexion();
        $this->authManager = new AuthManager($this->connexion);  
        $this->userManager = new UserManager($this->connexion);
        $this->validationService = new Validation($this->authManager, $this->userManager);
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
        $registerValid = $this->validationService->registerValidation($_POST);

        if($registerValid === true)
        {
            $this->userManager->add(new User($_POST));
            $nbUsers = count($this->userManager->getAll());
            $idUser = $nbUsers == 0 ? 1 : $this->userManager->getAll()[$nbUsers - 1]->getId();
            $this->authManager->add(new Auth(['idUser' => $idUser, 'login' => $_POST['pseudo'], 'mdp' => $_POST['mdp']]));
            $success = 'Votre inscription a bien été prise en compte !';
        }
        require_once('../Views/Auth/inscription.php');
    }

    public function login()
    {
        if($this->validationService->authValidation($_POST))
        {
            echo "OK !"; die;
        }
        else 
        {
            $error = "Login ou mot de passe incorrecte !";
            require_once('../Views/Auth/connexion.php');
        }
    }
}