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
    private $userManager;
    private $validationService;
    private $articleManager;
    private $categorieManager;

    public function __construct()
    {
        SessionManager::start();
        $this->connexion = Connexion::getConnexion();
        $this->articleManager = new ArticleManager($this->connexion);  
        $this->categorieManager = new CategorieManager($this->connexion);  
        $this->authManager = new AuthManager($this->connexion);  
        $this->userManager = new UserManager($this->connexion);
        $this->validationService = new Validation($this->authManager, $this->userManager, $this->categorieManager);
    }

    public function inscription()
    {
        require_once('../Views/Auth/inscription.php');
    }

    public function connexion()
    {
        if(SessionManager::get('user'))
        {
            SessionManager::get('user')->getStatut() === 'user' ? require_once('../Views/User/Membre/index.php') : require_once('../Views/User/Admin/index.php');
        }
        else
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
        SessionManager::get('add') ? require_once('../Views/User/Admin/user.php') : require_once('../Views/Auth/inscription.php');
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
                $user->getStatut() === 'user' ? require_once('../Views/User/Membre/index.php') : require_once('../Views/User/Admin/index.php');
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
            require_once('../Views/User/Membre/articles.php');
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
            require_once('../Views/User/Membre/writeArticle.php');
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
                require_once('../Views/User/Membre/writeArticle.php');
            }
            else
            {
                $error = $response;
                require_once('../Views/User/Membre/writeArticle.php');
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

    public function gestionArticle()
    {
        if(SessionManager::get('user'))
        {
            $articles = $this->articleManager->getAll();
            require_once('../Views/User/Admin/gestionArticle.php');
        }
        else
            $this->connexion();
    }

    public function gestionMembre()
    {
        if(SessionManager::get('user'))
        {
            $membres = $this->userManager->getAllMembres();
            require_once('../Views/User/Admin/gestionMembre.php');
        }
        else
            $this->connexion();
    }

    public function gestionAdmin()
    {
        if(SessionManager::get('user'))
        {
            $allAdmins = $this->userManager->getAllAdmins();
            $admins = array_filter($allAdmins, function($admin){
                return $admin != SessionManager::get('user');
            });
            require_once('../Views/User/Admin/gestionAdmin.php');
        }
        else
            $this->connexion();
    }

    public function gestionCategorie()
    {
        if(SessionManager::get('user'))
        {
            $categories = $this->categorieManager->getAll();
            require_once('../Views/User/Admin/gestionCategorie.php');
        }
        else
            $this->connexion();
    }

    public function addCategorie()
    {
        if(SessionManager::get('user'))
        {
            require_once('../Views/User/Admin/addCategorie.php');
        }
        else
            $this->connexion();
    }

    public function storeCategorie()
    {
        if(SessionManager::get('user'))
        {
            $response = $this->validationService->categorieValidation($_POST);
            if($response === true)
            {
                $this->categorieManager->add(new Categorie(['id' => '', 'libelle' => $_POST['libelle']]));
                $success = 'Votre catégorie a bien été enregistré !';
                require_once('../Views/User/Admin/addCategorie.php');
            }
            else
            {
                $error = $response;
                require_once('../Views/User/Admin/addCategorie.php');
            }
        }
        else
            $this->connexion();
    }

    public function editArticle()
    {
        if(SessionManager::get('user'))
        {
            $article = $this->articleManager->get($_GET['id']);
            $categories = (new CategorieManager($this->connexion))->getAll();
            SessionManager::set('categories', $categories);
            require_once('../Views/User/Membre/writeArticle.php');
        }
        else
            $this->connexion();
    }

    public function updateArticle()
    {
        if(SessionManager::get('user'))
        {
            $response = $this->validationService->articleValidation($_POST);
            $article = $this->articleManager->get($_POST['id_article']);

            if($response === true)
            {
                $article->setTitre($_POST['titre']);
                $article->setContenu($_POST['contenu']);
                $article->setCategorie($_POST['categorie']);
                $article->setAuteur(SessionManager::get('user')->getId());
                $this->articleManager->update($article);
                $success = 'Votre article a bien été mis à jour !';
                require_once('../Views/User/Membre/writeArticle.php');
            }
            else
            {
                $error = $response;
                require_once('../Views/User/Membre/writeArticle.php');
            }
        }
        else
            $this->connexion();
    }

    public function removeArticle()
    {
        if(SessionManager::get('user'))
        {
            $article = $this->articleManager->get($_GET['id']);
            $this->articleManager->remove($article);
            SessionManager::get('user')->getStatut() == 'admin' ? $this->gestionArticle() : $this->getMemberArticles();
        }
        else
            $this->connexion();
    }

    public function editCategorie()
    {
        if(SessionManager::get('user'))
        {
            $categorie = $this->categorieManager->get($_GET['id']);
            require_once('../Views/User/Admin/addCategorie.php');
        }
        else
            $this->connexion();
    }

    public function updateCategorie()
    {
        if(SessionManager::get('user'))
        {
            $response = $this->validationService->categorieValidation($_POST);
            $categorie = $this->categorieManager->get($_POST['id_categorie']);
            if($response === true)
            {
                $categorie->setLibelle($_POST['libelle']);
                $this->categorieManager->update($categorie);
                $success = 'Votre catégorie a bien été mise à jour !';
                require_once('../Views/User/Admin/addCategorie.php');
            }
            else
            {
                $error = $response;
                require_once('../Views/User/Admin/addCategorie.php');
            }
        }
        else
            $this->connexion();
    }

    public function removeCategorie()
    {
        if(SessionManager::get('user'))
        {
            $categorie = $this->categorieManager->get($_GET['id']);
            $this->categorieManager->remove($categorie);
            $this->gestionCategorie();
        }
        else
            $this->connexion();
    }

    public function addUser()
    {
        if(SessionManager::get('user'))
        {
            require_once('../Views/User/Admin/user.php');
        }
        else
            $this->connexion();
    }

    public function editUser()
    {
        if(SessionManager::get('user'))
        {
            $user = $this->userManager->get($_GET['id']);
            $auth = $this->authManager->getAuthByUser($_GET['id']);
            require_once('../Views/User/Admin/user.php');
        }
        else
            $this->connexion();
    }

    public function updateUser()
    {
        $registerValid = $this->validationService->registerValidation($_POST);
        $user = $this->userManager->get($_GET['id']);
        $auth = $this->authManager->getAuthByUser($_GET['id']);

        if(SessionManager::get('user'))
        {
            if($registerValid === true)
            {
                $user->setNom($_POST['nom']); $user->setPrenom($_POST['prenom']);
                $auth->setLogin($_POST['pseudo']); $user->setMail($_POST['mail']);
                $auth->setMdp($_POST['mdp']);
                $this->userManager->update($user);
                $this->authManager->update($auth);
                $success = 'Utilisateur mis à jour !';
                require_once('../Views/User/Admin/user.php');
            }
            else
            {
                $error = $registerValid;
                require_once('../Views/User/Admin/user.php');
            }  
        }
        else
            $this->connexion();
    }

    public function removeUser()
    {
        if(SessionManager::get('user'))
        {
            $user = $this->userManager->get($_GET['id']);
            $auth = $this->authManager->getAuthByUser($_GET['id']);
            $this->authManager->remove($auth);
            $this->userManager->remove($user);
            $_GET['action'] == 'removeAdmin' ? $this->gestionAdmin() : $this->gestionMembre();
        }
        else
            $this->connexion();
    }
}