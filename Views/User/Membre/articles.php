<?php $title = 'Mon espace perso'; 

$entete = 'Mon espace perso';

ob_start();

?>

<div id="contenu">
<h1>Liste de mes articles</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=writeArticle">Ecrire un nouvel article</a></p>
    <?php if(empty($articles)){ ?>
    <h2>Vous n'avez pas encore d'article(s).</h2>
    <?php } else{ ?>
        <table>
            <tr>
                <th><b>Titre</b></th>
                <th><b>Date de publication</b></th>
                <th align="center"><b>Opérations</b></th>
            </tr>     
        <?php foreach($articles as $article) {
        ?>
        <tr>
            <td><?= $article->getTitre() ?></td>
            <td> <?= $article->getDateCreation() ?> </td>
            <td><button>Détails</button> <button>Modifier</button></td>
        </tr>
    <?php } 
    ?> </table>
<?php } ?>
</div>

<style>
 table 
 {
    border-collapse: collapse; 
 }
td, th
{
    border: 1px solid black;
}
</style>

<?php $content = ob_get_clean(); 

require_once('../Views/User/layoutMembre.php');

?>