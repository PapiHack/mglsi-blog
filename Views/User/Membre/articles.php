<?php $title = 'Mon espace perso'; 

$entete = 'Mon espace perso';

ob_start();

?>

<div id="contenu">
<h1>Liste de mes articles</h1>
    <?php if(empty($articles)){ ?>
    <h2>Vous n'avez pas encore d'article(s).</h2>
    <?php } else{ ?>
        <ul>
        <?php foreach($articles as $article) {
        ?>
        <li> <?= $article->getTitre() ?> <small>Publié le <?= $article->getDateCreation() ?></small> </li>
    <?php } 
    ?> </ul>
<?php } ?>
</div>

<?php $content = ob_get_clean(); 

require_once('../Views/User/layoutMembre.php');

?>