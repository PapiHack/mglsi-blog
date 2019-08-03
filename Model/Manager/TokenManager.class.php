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
 * Classe permettant la gestion des tokens.
 * 
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
        $request = $this->db->prepare('INSERT INTO Token (idUser, token) VALUES(:idUser, :token)');

        return $request->execute([
            'idUser' => $token->getIdUser(),
            'token'  => $token->getToken()
        ]);
    }

    public function remove(Token $token)
    {
        $request = $this->db->prepare('DELETE FROM Token WHERE id = :id');

        return $request->execute([
            'id' => $token->getId()
        ]);
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
    
    public function getTokenByUser($idUser)
    {
        $idUser = (int) $idUser;
        $request = $this->db->prepare('SELECT * FROM Token WHERE idUser = :idUser');

        $request->execute([
            'idUser' => $idUser
        ]);
        
        $data = $request->fetch(PDO::FETCH_ASSOC);

        $token = ($data === false) ? null : new Token($data);
        return $token;
    }

    public function get($id)
    {
        $id = (int) $id;

        $request = $this->db->query('SELECT * FROM Token WHERE id = '.$id);
        $data = $request->fetch(PDO::FETCH_ASSOC);

        $token = ($data === false) ? null : new Token($data);
        return $token;
    }

    public function update(Token $token)
    {
        $request = $this->db->prepare('UPDATE Token SET token = :token, WHERE id = :id');
        
        return $request->execute([
            'token' => $token->getToken(),
            'id'    => $token->getId()
        ]);
    }
}