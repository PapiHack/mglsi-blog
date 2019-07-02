<?php

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 * Ce fichier représente le contrôle frontal de l'application également appelé FrontController.
 * Toutes les requêtes passent par ce fichier; il fait la correspondance entre l'url saisit
 * par l'utiisateur et l'action à executer.
 */

 require_once('../Controller/BlogController.php');
 require_once('../Controller/AuthController.php');

 $blogController = new BlogController;
 $authController = new AuthController;

 if(isset($_GET['id']))
 {
     $blogController->article();
 }
 else if(isset($_GET['categorie']))
 {
     $blogController->articleByCategory();
 }
 else if(isset($_GET['action']))
 {
     if($_GET['action'] === 'inscription')
     {
        $authController->inscription();
     }
     else if($_GET['action'] === 'connexion')
     {
        $authController->connexion();
     }
     else if($_GET['action'] === 'register')
     {
        $authController->register();
     }
 }

 $blogController->index();