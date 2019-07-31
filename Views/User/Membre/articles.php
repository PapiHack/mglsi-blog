<?php $title = 'Mon espace perso'; 

$entete = 'Mon espace perso';

ob_start();

?>

<div id="contenu">
<h1>Liste de mes articles</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=writeArticle" class="btn btn-success"><i class="fa fa-edit"></i>  Ecrire un nouvel article</a></p>
    <br>
    <?php if(empty($articles)){ ?>
    <h2>Vous n'avez pas encore d'article(s).</h2>
    <?php } else{ ?>
        <table id="tab" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Titre</b></th>
                    <th><b>Date de publication</b></th>
                    <th><b>Opérations</b></th>
                </tr> 
            </thead>    

            <tbody>
                <?php foreach($articles as $article) { ?>
                    <tr>
                        <td><?= $article->getTitre() ?></td>
                        <td> <?= $article->getDateCreation() ?> </td>
                        <td>
                            <a href="" class="btn btn-primary" title="Détails"><i class="fa fa-book"></i></a>
                            <a href="" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>             
                            <a href="" class="btn btn-danger sup" title="Supprimer"><i class="fa fa-trash"></i></a>             
                        </td>
                    </tr>
                <?php } ?> 
        </tbody>
    </table>
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

<script>
    $(document).ready(function() {
        $('#tab').DataTable()
    })
</script>