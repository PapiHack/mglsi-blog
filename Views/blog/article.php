<?php $title = 'Actualités MGLSI';

if(SessionManager::get('user') && SessionManager::get('user')->getStatut() == 'admin')
    $entete = 'ESPACE ADMIN';
else if(SessionManager::get('user') && SessionManager::get('user')->getStatut() == 'user')
    $entete = 'Mon espace perso';
else
    $entete = 'Site d\'actualités du MGLSI';

ob_start();

?>

<div id="contenu">
    <?php if($article != null) { ?>
        <h1><?= $article->getTitre() ?></h1>
        <span>Publié le <?= $article->getDateCreation() ?></span>
        <p><?= $article->getContenu() ?></p>
    <?php } else { ?>
        <!-- <meta http-equiv="refresh" content="3; url=index.php"> -->
        <h1>Aucun article trouvé !</h1>
    <?php } ?>
</div>

<?php

$content = ob_get_clean();

if(SessionManager::get('user') && SessionManager::get('user')->getStatut() == 'admin')
    require_once('../Views/User/layoutAdmin.php');
else if(SessionManager::get('user') && SessionManager::get('user')->getStatut() == 'user')
    require_once('../Views/User/layoutMembre.php');
else
    require_once('../Views/layout.php');

?>
