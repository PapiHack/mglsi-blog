<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des admins</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=addAdmin" class="btn btn-success"><i class="fa fa-user-plus"></i> Ajouter un nouveau admin</a></p>
    <?php if(empty($admins)) { ?>
    <h2>Pas encore d'admin(s).</h2>
    <?php } else { ?>
        <table id="tab" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Nom</b></th>
                    <th><b>Mail</b></th>
                    <th><b>Pseudo</b></th>
                    <th><b>Opérations</b></th>
                </tr> 
            </thead> 

            <tbody>   
            <?php foreach($admins as $admin) { ?>
                <tr>
                    <td><?= $admin->getPrenom().' '.$admin->getNom() ?></td>
                    <td><?= $admin->getMail() ?></td>
                    <?php $userAuth = $this->authManager->getAuthByUser($admin->getId());  ?>
                    <td><?= $userAuth->getLogin() ?></td>
                    <td>
                        <a href="index.php?action=editUser&id=<?= $admin->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>             
                        <a href="index.php?action=removeUser&id=<?= $admin->getId() ?>" class="btn btn-danger sup" title="Supprimer"><i class="fa fa-trash"></i></a>             
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
    $(document).ready(function() {
        $('#tab').DataTable()
    })
</script>