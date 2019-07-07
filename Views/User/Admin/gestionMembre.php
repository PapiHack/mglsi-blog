<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des membres</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=connexion">Ajouter un nouveau membre</a></p>
    <?php if(empty($membres)){ ?>
    <h2>Pas encore de membre(s).</h2>
    <?php } else{ ?>
        <table>
            <tr>
                <th><b>Nom</b></th>
                <th><b>Mail</b></th>
                <th><b>Pseudo</b></th>
                <th align="center"><b>Opérations</b></th>
            </tr>     
        <?php foreach($membres as $membre) {
        ?>
        <tr>
            <td><?= $membre->getPrenom().' '.$membre->getNom() ?></td>
            <td><?= $membre->getMail() ?></td>
            <?php $userAuth = $this->authManager->getAuthByUser($membre->getId());  ?>
            <td><?= $userAuth->getLogin() ?></td>
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