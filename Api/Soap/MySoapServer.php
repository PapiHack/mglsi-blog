<?php


/**
 *
 */

 require_once('/var/www/html/mglsi-blog/Config/autoloader.php');
 require_once('vendor/autoload.php');
 use Zend\Soap\AutoDiscover;
 use Zend\Soap\Server;

class MySoapServer
{
  private $connexion;
  private $authManager;
  private $userManager;
  private $validationService;
  private $articleManager;
  private $categorieManager;
  private $tokenManager;
  private $tokenGenerator;
  private $allTokens;

  function __construct()
  {
    $this->connexion = Connexion::getConnexion();
    $this->articleManager = new ArticleManager($this->connexion);
    $this->categorieManager = new CategorieManager($this->connexion);
    $this->authManager = new AuthManager($this->connexion);
    $this->userManager = new UserManager($this->connexion);
    $this->tokenManager = new TokenManager($this->connexion);
    $this->tokenGenerator = new TokenGenerator($this->tokenManager->getAll());
    $this->validationService = new Validation($this->authManager, $this->userManager, $this->categorieManager);
    $this->allTokens = $this->tokenManager->getAll();
  }



  private function generateToken($idUser)
  {
    $tokenGenerator = new TokenGenerator($this->allTokens);
    $token = $tokenGenerator->getToken();
    $this->tokenManager->add(new Token([
        'idUser' => $idUser,
        'token'  => $token
      ]));
    return $token;
  }

  private function isValidToken(Token $token)
  {
    foreach($this->allTokens as $tok)
    {
        if($token->getToken() === $tok->getToken())
        {
            return true;
        }
    }
    return false;
  }

  public function revokeToken(Token $token)
  {
    $this->tokenManager->remove($token);
  }

  public function connect(ConnexionData $connexionData)
  {
    $token['idUser'] = '';
    $token['token'] = '';
    $newToken = new Token($token);
    if((isset($connexionData->pseudo)) && (isset($connexionData->password)))
    {
      $data = array(
        'pseudo' => $connexionData->pseudo,
        'mdp' => $connexionData->password
      );
      if($this->validationService->authValidation($data))
      {
        $userAuth = $this->authManager->getAuth($_POST['pseudo'], $_POST['mdp']);
        $user = $this->authManager->getUserAuthenticated($userAuth->getId());
        if($user->getStatut() === 'admin')
        {
          $token['token'] = $this->generateToken($user->getId);
          $token['idUser'] = $user->getId;
          $newToken = new Token($token);
          return $newToken;
        }
        return $newToken;
      }
    }

    return $newToken;
  }

  public function addUser(User $user,Token $token)
  {
    if(isValidToken($token))
    {
      return $this->userManager->add($user);
    }
    return false;
  }

  public function getAllUser(Token $token)
  {
    if(isValidToken($token))
    {
      return $this->userManager->getAll();
    }

    return [];
  }

  // public function getUserById($id,Token $token)
  // {
  //   if(isValidToken($token))
  //   {
  //     return $this->userManager->get($id);
  //   }
  //
  //   return [];
  // }

  public function updateUser(User $user,Token $token)
  {
    if(isValidToken($token))
    {
      return $this->userManager->update($user);
    }

    return false;
  }

  public function removeUser(User $user,Token $token)
  {
    if(isValidToken($token))
    {
      return $this->userManager->remove($user);
    }

    return false;
  }

}

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//     if (!isset($_GET['wsdl'])) {
//         header('HTTP/1.1 400 Client Error');
//         return;
//     }

    $autodiscover = new AutoDiscover();
    $autodiscover->setOperationBodyStyle(array(
      'use' => 'literal',
      'namespace' => 'http://schemas.xmlsoap.org/soap/encoding/'
    ));
    $autodiscover->setClass('MySoapServer');
    $autodiscover->setUri('http://localhost/mglsi-blog/Api/Soap/MySoapServer.php');
    header('Content-Type: application/xml');
    echo $autodiscover->generate()->toXml();
    // $autodiscover->dump('fichier.wsdl');
//     return;
// }
//
// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//     header('HTTP/1.1 400 Client Error');
//     return;
// }
//
// // pointing to the current file here
// $soap = new Server("http://localhost/mglsi-blog/Api/Soap/MySoapServer.php?wsdl");
// $soap->setClass('MySoapServer');
// $soap->handle();
