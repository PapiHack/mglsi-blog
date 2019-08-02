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

 if(isset($_GET['categorie']))
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
        case 'details': if(isset($_GET['id']))
                            $blogController->article();
                        break;
        case 'editArticle': if(isset($_GET['id']))
                                $authController->editArticle();
                            break;
        case 'removeArticle': if(isset($_GET['id']))
                                $authController->removeArticle();
                            break;
        case 'updateArticle': $authController->updateArticle();
                            break;
        case 'editCategorie': if(isset($_GET['id']))
                                $authController->editCategorie();
                            break;
        case 'removeCategorie': if(isset($_GET['id']))
                                $authController->removeCategorie();
                            break;
        case 'updateCategorie': $authController->updateCategorie();
                            break;
        case 'addAdmin': SessionManager::set('add', 'admin');
                            $authController->addUser();
                            break;
        case 'addEditor': SessionManager::set('add', 'user');
                        $authController->addUser();
                            break;
        case 'removeAdmin': if(isset($_GET['id']))
                                $authController->removeUser();
                        break;
        case 'removeEditor': if(isset($_GET['id']))
                                $authController->removeUser();
                            break;
        case 'editAdmin': SessionManager::set('add', 'admin'); 
                         $authController->editUser();
                        break;
        case 'editEditor': SessionManager::set('add', 'user'); 
                                         $authController->editUser();
                                        break;
        case 'updateUser': if(isset($_GET['id']))
                                $authController->updateUser();
                           break;
        default : $blogController->index();
                        break;
        
     }
 }
 else
    $blogController->index();