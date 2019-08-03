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

 define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
 define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
 $uri = explode('/',WEBROOT);
 define('URI','/'.$uri[1].'/');

 require_once('../Config/autoloader.php');

 $router = new Router($_GET['url']);

 $router->get('/','BlogController@index');
 $router->get('/index','BlogController@index');

 $router->get('/categorie/:id','BlogController@articleByCategory');
 $router->get('/article/:id','BlogController@articleById');

// GET Request
 $router->get('/inscription','AuthController@inscription');
 $router->get('/connexion','AuthController@connexion');
 $router->get('/login','AuthController@login');
 $router->get('/logout','AuthController@logout');
 $router->get('/writeArticle','AuthController@writeArticle');
 $router->get('/gestionArticle','AuthController@gestionArticle');
 $router->get('/gestionAdmin','AuthController@gestionAdmin');
 $router->get('/gestionMembre','AuthController@gestionMembre');
 $router->get('/getMemberArticles','AuthController@getMemberArticles');
 $router->get('/addCategorie','AuthController@addCategorie');
 $router->get('/gestionCategorie','AuthController@gestionCategorie');

//POST Request
 $router->post('/register','AuthController@register');
 $router->post('/login','AuthController@login');
 $router->post('/writeArticle','AuthController@writeArticle');
 $router->post('/gestionArticle','AuthController@gestionArticle');
 $router->post('/gestionAdmin','AuthController@gestionAdmin');
 $router->post('/gestionMembre','AuthController@gestionMembre');
 $router->post('/storeCategorie','AuthController@storeCategorie');
 $router->post('/storeWrittedArticle','AuthController@storeWrittedArticle');

 $router->run();

 // require_once('../Controller/BlogController.php');
 // require_once('../Controller/AuthController.php');

 // $blogController = new BlogController;
 // $authController = new AuthController;
 //
 // if(isset($_GET['id']))
 // {
 //     $blogController->article();
 // }
 // else if(isset($_GET['categorie']))
 // {
 //     $blogController->articleByCategory();
 // }
 // else if(isset($_GET['action']))
 // {
 //     switch ($_GET['action'])
 //     {
 //        case 'inscription': $authController->inscription();
 //                            break;
 //        case 'connexion': $authController->connexion();
 //                            break;
 //        case 'register': $authController->register();
 //                            break;
 //        case 'login': $authController->login();
 //                            break;
 //        case 'logout': $authController->logout();
 //                            break;
 //        case 'getMemberArticles': $authController->getMemberArticles();
 //                            break;
 //        case 'writeArticle': $authController->writeArticle();
 //                            break;
 //        case 'storeWrittedArticle': $authController->storeWrittedArticle();
 //                            break;
 //        case 'gestionArticle': $authController->gestionArticle();
 //                            break;
 //        case 'gestionMembre': $authController->gestionMembre();
 //                            break;
 //        case 'gestionAdmin': $authController->gestionAdmin();
 //                            break;
 //        case 'gestionCategorie': $authController->gestionCategorie();
 //                            break;
 //        case 'addCategorie': $authController->addCategorie();
 //                            break;
 //        case 'storeCategorie': $authController->storeCategorie();
 //                            break;
 //        default : $blogController->index();
 //                        break;
 //
 //     }
 // }
 // else
 //    $blogController->index();
