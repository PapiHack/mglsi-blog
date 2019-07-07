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

 // Refactoring à faire ===> switch case au lieu des else if !!!!!!!

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
     else if($_GET['action'] === 'login')
     {
         $authController->login();
     }
     else if($_GET['action'] === 'logout')
     {
         $authController->logout();
     }
     else if($_GET['action'] === 'getMemberArticles')
     {
         $authController->getMemberArticles();
     }
     else if($_GET['action'] === 'writeArticle')
     {
         $authController->writeArticle();
     }
     else if($_GET['action'] === 'storeWrittedArticle')
     {
         $authController->storeWrittedArticle(); 
     }
     else if($_GET['action'] === 'gestionArticle')
     {
         $authController->gestionArticle();
     }
     else if($_GET['action'] === 'gestionMembre')
     {
         $authController->gestionMembre();
     }
     else if($_GET['action'] === 'gestionAdmin')
     {
         $authController->gestionAdmin();
     }
     else if($_GET['action'] === 'gestionCategorie')
     {
         $authController->gestionCategorie();
     }
     else if($_GET['action'] === 'addCategorie')
     {
         $authController->addCategorie();
     }
     else if($_GET['action'] === 'storeCategorie')
     {
         $authController->storeCategorie();
     }
 }

 $blogController->index();