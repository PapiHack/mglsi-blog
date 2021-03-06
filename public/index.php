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
 require_once('../Api/Rest/Controller/ArticleApiController.php');

 $router = new Router($_GET['url']);

 $router->get('/','BlogController@index');
 $router->get('/index','BlogController@index');

 $router->get('/categorie/:id','BlogController@articleByCategory');
 $router->get('/article/:id','BlogController@articleById');
 $router->get('/page/:id','BlogController@index');

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
 $router->get('/revokeToken','AuthController@gestionAdmin');
 $router->get('/removeAdmin','AuthController@gestionMembre');
 $router->get('/removeArticle','AuthController@gestionArticle');
 $router->get('/removeCategorie','AuthController@gestionCategorie');
 $router->get('/removeEditor','AuthController@gestionMembre');

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

 // API Request
 $router->get('/Api/Rest/article/:id','ArticleApiController@getById');
 $router->get('/Api/Rest/article/:id/:type','ArticleApiController@getById');
 $router->get('/Api/Rest/articles','ArticleApiController@get');
 $router->get('/Api/Rest/articles/:type','ArticleApiController@get');
 $router->get('/Api/Rest/articles/categorie/:id','ArticleApiController@getArticleByCategory');
 $router->get('/Api/Rest/articles/categorie/:id/:type','ArticleApiController@getArticleByCategory');
 $router->get('/Api/Rest/articlesByCategory','ArticleApiController@getAllArticlesGroupByCategory');
 $router->get('/Api/Rest/articlesByCategory/:type','ArticleApiController@getAllArticlesGroupByCategory');
 $router->get('/ApiDoc','ArticleApiController@displayApiDocumentation');
 $router->get('/Api','ArticleApiController@displayApiDocumentation');
 $router->get('/Api/Rest','ArticleApiController@displayApiDocumentation');


 $router->run();
