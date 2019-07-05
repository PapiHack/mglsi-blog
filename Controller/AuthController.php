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
    private $membre;
    private $articleManager;

    public function __construct()
    {
        SessionManager::start();
        $this->auth = true; 
        $this->connexion = Connexion::getConnexion();
        $this->articleManager = new ArticleManager($this->connexion);  
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
        if(SessionManager::get('user'))
        {
            if(SessionManager::get('user')->getStatut() === 'user')
            {
                require_once('../Views/User/Membre/index.php');
                die();
            }
            else if(SessionManager::get('user')->getStatut() === 'admin')
            {
                require_once('../Views/User/Admin/index.php');
                die();
            }
        }
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
        
        if(SessionManager::get('user'))
        {
            $this->connexion();
        }
        else 
        {
            if($this->validationService->authValidation($_POST))
            {
                $userAuth = $this->authManager->getAuth($_POST['pseudo'], $_POST['mdp']);
                $user = $this->authManager->getUserAuthenticated($userAuth->getId());
                SessionManager::set('user', $user);
                SessionManager::set('userAuth', $userAuth);
                $this->membre = $user->getStatut() === 'user' ? true : false;
                ($this->membre) == true ? require_once('../Views/User/Membre/index.php') : require_once('../Views/User/Admin/index.php');
                die;
            }
            else 
            {
                $error = "Login ou mot de passe incorrecte !";
                require_once('../Views/Auth/connexion.php');
            }
        }
    }

    public function getMemberArticles()
    {
        if(SessionManager::get('user'))
        {
            $articles = $this->articleManager->getArticleByAuthor($_SESSION['user']->getId());
            require_once('../Views/User/Membre/articles.php'); die;
        }
        else
            $this->connexion();
    }

    public function writeArticle()
    {
        if(SessionManager::get('user'))
        {
            $categories = (new CategorieManager($this->connexion))->getAll();
            SessionManager::set('categories', $categories);
            require_once('../Views/User/Membre/writeArticle.php'); die();
        }
        else
            $this->connexion();
    }

    public function storeWrittedArticle()
    {

        if(SessionManager::get('user'))
        {
            $response = $this->validationService->articleValidation($_POST);
            if($response === true)
            {
                $article = new Article($_POST);
                $article->setAuteur(SessionManager::get('user')->getId());
                $this->articleManager->add($article);
                $success = 'Votre article a bien été enregistré et publié !';
                require_once('../Views/User/Membre/writeArticle.php'); die();
            }
            else
            {
                $error = $response;
                require_once('../Views/User/Membre/writeArticle.php'); die();
            }
        }
        else
            $this->connexion();
    }

    public function logout()
    {
        SessionManager::destroy();
        require_once('../Views/Auth/connexion.php');
    }
}