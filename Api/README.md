# API REST de mglsi_news  

Ce repertoire contient le code métier de notre API. Une documentaion est disponible à l'url
suivante : `<votre_serveur>/mglsi_news/public/apidoc/`.  

## Architecture de l'API  

Pour la conception de cette API, une architecture simple a été mise en place basée sur trois (3) couche :  

    - Config
    Contenant la configuration (autoloader.php pour l'autochargement des classes à leur instanciation,database.php spécifie les paramètres de connexion à votre BD.)

    - Controller
    Contenant les différents controlleurs de l'API. Ici nous n'avons que ArticleApiController.php qui gère tout ce qui est récupération des articles.

    - public
    Contenant notre index.php et qui est notre routeur. C'est le point d'entrée de l'API et permet de dispatcher les requêtes. 

    - Swagger  
    Contenant les fichiers de documentation (Swagger) de l'API au format JSON et YAML.  

    - Utilities  
    Contient des utilitaires. Ici il n'y qu'un fichier HydratationTrait.php contenant une méthode réalisant l'hydratation d'un objet.  
