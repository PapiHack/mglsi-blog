<?php $title = 'Actualités MGLSI'; 

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
    <?php 
        if(count($this->allArticles) == 0)
            echo "<h1>Aucun article trouvé !</h1>";
        else
            foreach ($this->allArticles as $article)
            {?>
                <div class="article">
                    <h1><a href="index.php?id=<?= $article->getId() ?>"><?= utf8_encode($article->getTitre()) ?></a></h1>
                    <p><?= substr($article->getContenu(), 0, 300) . '...' ?></p>
                </div><?php
            }
    ?>
</div>

<?php $content = ob_get_clean(); 

require_once('../Views/layout.php');

?>