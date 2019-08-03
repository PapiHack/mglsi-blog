<?php $title = 'Mon espace perso';

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des catégories</h1>
<p style="font-size: 1.5em;"><a href="<?= URI?>addCategorie" class="btn btn-success"> <i class="fa fa-plus"></i> Ajouter une nouvelle catégorie</a></p>
        <br>
    <?php if(empty($categories)){ ?>
    <h2>Pas encore de catégorie(s).</h2>
    <?php } else{ ?>
        <table id="tab" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><b>Id</b></th>
                <th><b>Libellé</b></th>
                <th align="center"><b>Opérations</b></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($categories as $categorie) { ?>
                <tr>
                    <td><?= $categorie->getId() ?></td>
                    <td><?= $categorie->getLibelle() ?></td>
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

<?php $content = ob_get_clean();

require_once('../Views/User/layoutAdmin.php');

?>

<script>
    $(document).ready(function(){
        $('#tab').DataTable()
    })
</script>
