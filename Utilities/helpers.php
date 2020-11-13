<?php

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Je définis ici quelques helpers.
 * 
 */

 /**
 * Fontion permettant de retourner le chemin de la ressource passée en paramètre.
 *
 * @param   String  $file  ressource demandée
 *
 * @return  path         chemin de la ressource demandée
 */
function asset($file)
{
    return '../public/assets/'.$file;
}