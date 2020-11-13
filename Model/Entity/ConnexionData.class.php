<?php

/**
 *
 */

require_once('../Utilities/HydratationTrait.php');


class ConnexionData
{
  use HydratationTrait;
  private $pseudo;
  private $password;

  function __construct(Array $data)
  {
    $this->hydrate($data);
  }

    /**
     * Get the value of Pseudo
     *
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of Pseudo
     *
     * @param mixed pseudo
     *
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
