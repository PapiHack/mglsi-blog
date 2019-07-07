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
 * 
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
     switch ($_GET['action'])
     {
        case 'inscription': $authController->inscription();
                            break;
        case 'connexion': $authController->connexion();
                            break;
        case 'register': $authController->register();
                            break;
        case 'login': $authController->login();
                            break;
        case 'logout': $authController->logout();
                            break;
        case 'getMemberArticles': $authController->getMemberArticles();
                            break;
        case 'writeArticle': $authController->writeArticle();
                            break;
        case 'storeWrittedArticle': $authController->storeWrittedArticle();
                            break;
        case 'gestionArticle': $authController->gestionArticle();
                            break;
        case 'gestionMembre': $authController->gestionMembre();
                            break;
        case 'gestionAdmin': $authController->gestionAdmin();
                            break;
        case 'gestionCategorie': $authController->gestionCategorie();
                            break;
        case 'addCategorie': $authController->addCategorie();
                            break;
        case 'storeCategorie': $authController->storeCategorie();
                            break;
        default : $blogController->index();
                        break;
        
     }
 }
 else
    $blogController->index();