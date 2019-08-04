<?php

/**
 * 
 * @author P@piHack3R
 * @since 04/08/19
 * @version 1.0.0
 * 
 * Ce fichier représente le contrôle frontal de l'API également appelé FrontController.
 * Toutes les requêtes passent par ce fichier; il fait la correspondance entre l'url saisit
 * par l'utiisateur et l'action à executer.
 * 
 */

 require_once('../Controller/ArticleApiController.php');

 $articleApiController = new ArticleApiController();

if($_GET['action'] == 'get')
    $articleApiController->get();
else if(isset($_GET['id']) && $_GET['action'] == 'getById')
    $articleApiController->getById($_GET['id']);
else if(isset($_GET['id']) && $_GET['action'] == 'getByCateg')
    $articleApiController->getArticleByCategory($_GET['id']);