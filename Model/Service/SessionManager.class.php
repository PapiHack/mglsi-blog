<?php
/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * 
 * Classe permettant et facilitant la gestion des sessions.
 * 
 */
class SessionManager
{
    private static $sessionStarted = false;

    public static function start()
    {
        if(self::$sessionStarted == false)
        {
            session_start();
            self::$sessionStarted = true;
        }
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function debug()
    {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }

    public static function destroy()
    {
        if(self::$sessionStarted)
        {
            session_unset();
            session_destroy();
            $_SESSION = [];
        }
    }
}