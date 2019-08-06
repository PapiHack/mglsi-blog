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
 // $router = new Router($_GET['url']);
 //
 // $router->get('/Apiarticles','ArticleApiController@get');
 // $router->get('/Apiarticles/:type','ArticleApiController@get');
 // $router->get('/Apiarticle/:id','ArticleApiController@getById');
 // $router->get('/Apiarticle/:id/:type','ArticleApiController@getById');
 // $router->get('/Apiarticlescategorie/:id','ArticleApiController@getArticleByCategory');
 // $router->get('/Apiarticlescategorie/:id/:type','ArticleApiController@getArticleByCategory');
 // $router->get('/ApiarticlesByCategory','ArticleApiController@getAllArticlesGroupByCategory');
 // $router->get('/ApiarticlesByCategory/:type','ArticleApiController@getAllArticlesGroupByCategory');
 //
 //
 // $router->run();

 $articleApiController = new ArticleApiController();

if(isset($_GET['action']))
{
    if($_GET['action'] == 'articles')
        echo $articleApiController->get();
    else if($_GET['action'] == 'article' && isset($_GET['id']))
        echo $articleApiController->getById($_GET['id']);
    else if($_GET['action'] == 'articlescategorie' && isset($_GET['id']))
        echo $articleApiController->getArticleByCategory($_GET['id']);
    else if($_GET['action'] == 'articlesByCategory')
        echo $articleApiController->getAllArticlesGroupByCategory();
}
else
    $articleApiController->displayApiDocumentation();
