<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des membres</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=addEditor" class="btn btn-success"><i class="fa fa-user-plus"></i> Ajouter un nouveau membre</a></p>
    <br>
    <?php if(empty($membres)){ ?>
    <h2>Pas encore de membre(s).</h2>
    <?php } else{ ?>
        <table class="table table-striped table-bordered" id="tab">
            <thead>
                <tr>
                    <th><b>Nom</b></th>
                    <th><b>Mail</b></th>
                    <th><b>Pseudo</b></th>
                    <th><b>Opérations</b></th>
                </tr>  
            </thead>   

            <tbody>
                <?php foreach($membres as $membre) { ?>
                    <tr>
                        <td><?= $membre->getPrenom().' '.$membre->getNom() ?></td>
                        <td><?= $membre->getMail() ?></td>
                        <?php $userAuth = $this->authManager->getAuthByUser($membre->getId());  ?>
                        <td><?= $userAuth->getLogin() ?></td>
                        <td>
                            <a href="index.php?action=editEditor&id=<?= $membre->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>             
                            <a href="index.php?action=removeEditor&id=<?= $membre->getId() ?>" class="btn btn-danger sup" title="Supprimer"><i class="fa fa-trash"></i></a>             
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
    $(document).ready(function (){
        $('#tab').DataTable()
    })

    var editors = document.getElementsByClassName('sup')
    for(var i = 0; i < editors.length; i++)
    {
        editors[i].addEventListener('click', function(event){
            if(!confirm('Voulez vous vraiment supprimer cet éditeur ?'))
                event.preventDefault()
        })
    }
</script>