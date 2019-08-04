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
 $router->get('/addCategorie','AuthController@addCategorie');
 $router->get('/addAdmin','AuthController@addUser');
 $router->get('/addEditor','AuthController@addUser');
 $router->get('/generateToken/:id','AuthController@generateToken');

 $router->get('/editEditor/:id','AuthController@editUser');
 $router->get('/editAdmin/:id','AuthController@editUser');
 $router->get('/editArticle/:id','AuthController@editArticle');
 $router->get('/editCategorie/:id','AuthController@editCategorie');

 $router->get('/gestionArticle','AuthController@gestionArticle');
 $router->get('/gestionAdmin','AuthController@gestionAdmin');
 $router->get('/gestionMembre','AuthController@gestionMembre');
 $router->get('/getMemberArticles','AuthController@getMemberArticles');
 $router->get('/gestionCategorie','AuthController@gestionCategorie');

 $router->get('/revokeToken/:id','AuthController@revokeToken');
 $router->get('/removeAdmin/:id','AuthController@removeUser');
 $router->get('/removeArticle/:id','AuthController@removeArticle');
 $router->get('/removeCategorie/:id','AuthController@removeCategorie');
 $router->get('/removeEditor/:id','AuthController@removeUser');

 //POST Request
 $router->post('/register','AuthController@register');
 $router->post('/login','AuthController@login');

 $router->post('/writeArticle','AuthController@writeArticle');
 $router->post('/storeCategorie','AuthController@storeCategorie');
 $router->post('/storeWrittedArticle','AuthController@storeWrittedArticle');

 $router->post('/gestionArticle','AuthController@gestionArticle');
 $router->post('/gestionAdmin','AuthController@gestionAdmin');
 $router->post('/gestionMembre','AuthController@gestionMembre');

 $router->post('/updateCategorie','AuthController@updateCategorie');
 $router->post('/updateUser/:id','AuthController@updateUser');
 $router->post('/updateArticle','AuthController@updateArticle');


 $router->run();

 // if(isset($_GET['categorie']))
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
 //        case 'details': if(isset($_GET['id']))
 //                            $blogController->article();
 //                        break;
 //        case 'editArticle': if(isset($_GET['id']))
 //                                $authController->editArticle();
 //                            break;
 //        case 'removeArticle': if(isset($_GET['id']))
 //                                $authController->removeArticle();
 //                            break;
 //        case 'updateArticle': $authController->updateArticle();
 //                            break;
 //        case 'editCategorie': if(isset($_GET['id']))
 //                                $authController->editCategorie();
 //                            break;
 //        case 'removeCategorie': if(isset($_GET['id']))
 //                                $authController->removeCategorie();
 //                            break;
 //        case 'updateCategorie': $authController->updateCategorie();
 //                            break;
 //        case 'addAdmin': SessionManager::set('add', 'admin');
 //                            $authController->addUser();
 //                            break;
 //        case 'addEditor': SessionManager::set('add', 'user');
 //                        $authController->addUser();
 //                            break;
 //        case 'removeAdmin': if(isset($_GET['id']))
 //                                $authController->removeUser();
 //                        break;
 //        case 'removeEditor': if(isset($_GET['id']))
 //                                $authController->removeUser();
 //                            break;
 //        case 'editAdmin': SessionManager::set('add', 'admin');
 //                         $authController->editUser();
 //                        break;
 //        case 'editEditor': SessionManager::set('add', 'user');
 //                                         $authController->editUser();
 //                                        break;
 //        case 'updateUser': if(isset($_GET['id']))
 //                                $authController->updateUser();
 //                           break;
 //        case 'generateToken': if(isset($_GET['id']))
 //                                $authController->generateToken();
 //                            break;
 //        case 'revokeToken': if(isset($_GET['id']))
 //                                $authController->revokeToken();
 //                            break;
 //        default : $blogController->index();
 //                        break;
 //
 //     }
 // }
 // else
 //    $blogController->index();
