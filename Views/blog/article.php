<?php $title = 'Actualités MGLSI'; 

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
    <?php if($article != null) { ?>
        <h1><?= $article->getTitre() ?></h1>
        <span>Publié le <?= $article->getDateCreation() ?></span>
        <p><?= $article->getContenu() ?></p>
    <?php } else { ?>
        <meta http-equiv="refresh" content="3; url=index.php">
        <h1>Aucun article trouvé !</h1>
    <?php } ?>
</div>

<?php

$content = ob_get_clean(); 

require_once('../Views/layout.php');

?>