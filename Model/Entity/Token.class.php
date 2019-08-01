<?php

/**
 *
 * @author alioune
 * @since 01/08/19
 */

class Token
{
  private $_idUser;
  private $_token;

  public function __construct($idUser,$token)
  {
    $this->_idUser = $idUser;
    $this->_token = $token;
  }




    /**
     * Get the value of Id User
     *
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->_idUser;
    }

    /**
     * Set the value of Id User
     *
     * @param mixed _idUser
     *
     * @return self
     */
    public function setIdUser($_idUser)
    {
        $this->_idUser = $_idUser;

        return $this;
    }

    /**
     * Get the value of Token
     *
     * @return mixed
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Set the value of Token
     *
     * @param mixed _token
     *
     * @return self
     */
    public function setToken($_token)
    {
        $this->_token = $_token;

        return $this;
    }

}
