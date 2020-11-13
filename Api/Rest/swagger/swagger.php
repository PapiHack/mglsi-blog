<?php

require_once('../vendor/autoload.php');

use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Documentation de l'API REST de la plateforme MGLSI_NEWS", 
 *          version="0.0.1",
 *          @OA\Contact(
 *              email="itdev94@gmail.com"
 *          ),
 * )
 * 
 * @OA\Server(
 *      url="http://localhost/mglsi-blog/Api/Rest",
 *      description="Cette url est la racine de toutes les endpoints à interroger."
 * )
 * 
 * @OA\Tag(
 *      name="article",
 *      description="Opérations et informations disponibles sur les articles .",
 *      @OA\ExternalDocumentation(
 *          description="Visitez le site du MGLSI_NEWS",
 *          url="http://localhost/mglsi-blog"
 *       )
 * )
 */

