<?php
/**
 * 
 * @author alioune
 * @since 04/08/19
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

    public function __construct(Array $allTokens)
    {
        $this->tokens = $allTokens;
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
        //return base64_encode(random_bytes(25));
        //return bin2hex(random_bytes(25));
    }

    private function exists($tok)
    {
        foreach($this->tokens as $token)
        {
            if($token->getToken() === $tok)
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
        while ($this->exists($token));

        return $token;
    }   
}