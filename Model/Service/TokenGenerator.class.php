<?php
/**
 * 
 * @author alioune
 * @since 02/07/19
 * @version 1.0.0
 * 
 * Refacto by P@piHack3R
 * 
 * Classe permettant la génération de token.
 * 
 */
class TokenGenerator
{
    private $tokens;

    public function __construct()
    {
        $tokens = (new TokenManager(ConnexionManager::getConnexion()))->getAll();
    }

    private function generateRandomString()
    {
        $randomString = [];
        $str = str_split('0123456789abcddefghijklmnopqrstuvwxyz@_-ABCCDEFGHIJKLMNOPQRSTUVWXYZ');
        $length = rand(10,65);
        for($i = 0; $i < $length; $i++)
        {
            $randomString [] = $str[rand(0,64)];
        }
        return implode('', $randomString);
    }

    private function exists($_token)
    {
        foreach($this->tokens as $token)
        {
            if($token->getToken() !== $_token)
            {
                return true;
            }
        }
        return false;
    }

    public function getToken()
    {
        $token = '';

        do
        {
            $token = $this->generateRandomString();
        } 
        while (exists($token));

        return $token;
    }   
}