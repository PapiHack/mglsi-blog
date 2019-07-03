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
        return $this->authManager->tryAuth($data['login'], $data['mdp']);
    }

    public function registerValidation(Array $data)
    {
        
        if($this->minLengthValidation($data['pseudo']))
        {
            if($this->minLengthValidation($data['mdp']))
            {
                if($this->passwordValidation($data['mdp'], $data['cmdp']))
                {
                    if($this->emailValidation($data['mail']))
                    {
                        if($this->userManager->pseudo_exist($data['pseudo']))
                        {
                            if($this->userManager->mail_exist($data['mail']))
                            {
                                echo "Validation OK !!!"; die();
                                // vérifier si le pseudo et l'@ mail (valide) existe via $userManager
                            }
                            else
                                $response['emailExist'] = 'Cette adresse email existe déjà.';
                        }
                        else
                            $response['pseudoExist'] = 'Ce pseudo existe déjà.';
                    }
                    else
                        $response['emailError'] = 'Adresse email invalide.';
                }
                else
                    $response['passwordError'] = 'Les mots de passe ne sont pas identiques.';
            }
            else
                $response['passwordLengthError'] = 'Le mot de passe doit être plus de 4 caractères.';
        }
        else
            $response['pseudo'] = 'Le pseudo être plus de 4 caractères.';

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
}