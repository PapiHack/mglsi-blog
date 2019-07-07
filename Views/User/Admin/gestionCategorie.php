<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des catégories</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=addCategorie">Ajouter une nouvelle catégorie</a></p>
    <?php if(empty($categories)){ ?>
    <h2>Pas encore de catégorie(s).</h2>
    <?php } else{ ?>
        <table>
            <tr>
                <th><b>Id</b></th>
                <th><b>Libellé</b></th>
                <th align="center"><b>Opérations</b></th>
            </tr>     
        <?php foreach($categories as $categorie) {
        ?>
        <tr>
            <td><?= $categorie->getId() ?></td>
            <td><?= $categorie->getLibelle() ?></td>
            <td><button>Détails</button> <button>Modifier</button> <button>Supprimer</button></td>
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

require_once('../Views/User/layoutAdmin.php');

?>