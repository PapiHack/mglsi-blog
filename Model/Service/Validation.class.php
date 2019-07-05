<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Classer permettant de gérer la validation de certains formulaires.
 */
class Validation 
{
    private $userManager;
    private $authManager;

    public function __construct(AuthManager $authManager, UserManager $userManager)
    {
        $this->authManager = $authManager;
        $this->userManager = $userManager;
    }

    public function authValidation(Array $data)
    {
        if($this->isNotEmpty($data))
        {
            return $this->authManager->tryAuth($data['pseudo'], $data['mdp']);
        }
        return false;
    }

    public function registerValidation(Array $data)
    {
        //$response = null;
        if($this->hasAllData($data))
        {
            if($this->minLengthValidation($data['pseudo']))
            {
                if($this->minLengthValidation($data['mdp']))
                {
                    if($this->passwordValidation($data['mdp'], $data['cmdp']))
                    {
                        if($this->emailValidation($data['mail']))
                        {
                            if(!$this->userManager->pseudo_exist($data['pseudo']))
                            {
                                if(!$this->userManager->mail_exist($data['mail']))
                                {
                                    return true;
                                    //echo "Validation OK !!!"; die();
                                }
                                else
                                    $response = ['error' => 'Cette adresse email existe déjà.', 'data' => $data];
                            }
                            else
                                $response = ['error' => 'Ce pseudo existe déjà.', 'data' => $data];
                        }
                        else
                            $response = ['error' => 'Adresse email invalide.', 'data' => $data] ;
                    }
                    else
                        $response = ['error' => 'Les mots de passe ne sont pas identiques.', 'data' => $data];
                }
                else
                    $response = ['error' => 'Le mot de passe doit être plus de 4 caractères.', 'data' => $data];
            }
            else
                $response = ['error' => 'Le pseudo être plus de 4 caractères.', 'data' => $data];
        }
        else
            $response = ['error' => 'Veuillez remplir tous les champs svp !', 'data' => $data];

        return $response;
    }

    private function minLengthValidation($str)
    {
        return strlen($str) >= 4 ;
    }

    private function emailValidation($mail)
    {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    private function passwordValidation($password, $confirm)
    {
        return $password === $confirm;
    }

    private function isNotEmpty(Array $data)
    {
        return isset($data) && !empty($data);
    }

    private function hasAllData(Array $data)
    {
        if($this->isNotEmpty($data))
        {
            foreach($data as $key => $value)
            {
                if(empty($value))
                    return false;
            }
            return true;
        }
    }

    public function articleValidation()
    {
        $response = ($this->hasAllData($_POST)) ? true : 'Veuillez remplir tous les champs svp !';
        return $response; 
    }
}