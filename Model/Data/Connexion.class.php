<?php

require_once('../Config/database.php');

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Classe permettant d'établir une connexion à la BD.
 * J'implémente ici le pattern Singleton.
 * 
 */
class Connexion 
{
    private static $connexion;

    /**
     * Initialise la connexion à la BD avec les paramètres définis dans la configuration.
     *
     * @return  Void  Nothing
     */
    private function __construct()
    {
        try 
        {
            self::$connexion = new PDO(DB_CONNECTION.':host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
        }
        catch(Exception $e)
        {
            echo 'Une erreur est survenue lors de la connection à la BD => '. $e->getMessage();
            die();
        }
    }
    
    /**
     * Méthode retournant une instance de la connexion à la BD
     *
     * @return  Connexion  l'objet connexion
     */
    public static function getConnexion()
    {
        if(self::$connexion === null)
            self::$connexion == new Connexion;
        return self::$connexion;
    }
}