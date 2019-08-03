<?php
/**
 * 
 * @author P@piHack3R
 * @since 02/07/19
 * @version 1.0.0
 * 
 */

require_once('../Utilities/HydratationTrait.php');

/**
 * 
 * Classe représentant un Token.
 * 
 */
class Token
{
    use HydratationTrait;

    private $id;
    private $idUser;
    private $token;

    public function __construct(Array $data)
    {
        $this->hydrate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($id)
    {
        $this->idUser = (int) $id;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }
}