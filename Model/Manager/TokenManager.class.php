<?php

/**
 *
 * @author alioune
 * @since 01/08/19
 */
class TokenManager
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getDb()
    {
        return $this->db;
    }

    private function setDb($db)
    {
        $this->db = $db;
    }

    public function add(Token $token)
    {
      $request = $this->db->prepare('INSERT INTO Token VALUES (:idUser,token)');
      return $request->execute(array(
        'idUser' => $token->getIdUser(),
        'token' => $token->getToken()
      ));
    }

    public function remove(Token $token)
    {
        return $this->db->exec('DELETE FROM Token WHERE id_user = '. $token->getIdUser());
    }

    public function getAll()
    {
        $tokens = array();

        $request = $this->db->query('SELECT * FROM Token');

        while($data = $request->fetch(PDO::FETCH_ASSOC))
        {
            $tokens [] = new Token($data);
        }

        return $tokens;
    }

    public function getByIdUser($idUser)
    {
      $request = $this->db->prepare('SELECT token FROM Token WHERE id_user =:id_user');
      $request->execute(array(
        'id_user' => $idUser
      ));
      return $request->fetch(PDO::FETCH_ASSOC);
    }
}
