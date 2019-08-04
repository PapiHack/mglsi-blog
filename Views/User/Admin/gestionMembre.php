<?php $title = 'Espace Admin';

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
<h1>Liste des membres</h1>
<p style="font-size: 1.5em;"><a href="<?= URI?>addEditor" class="btn btn-success"><i class="fa fa-user-plus"></i> Ajouter un nouveau membre</a></p>
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
                            <a href="<?= URI?>editEditor/<?= $membre->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>
                            <button type="button" id="<?= $membre->getId() ?>" class="btn btn-danger sup"><i class="fa fa-trash"></i></button>
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
                Swal.fire({
                    title: 'Voulez vous vraiment supprimer cet éditeur ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    //allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Non, annuler',
                    confirmButtonText: 'Oui, le supprimé !'
                    }).then((result) => {
                        if (result.value)
                        {
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Editeur supprimé !',
                                showConfirmButton: false,
                                timer: 1500,
                                })

                            // setTimeout(function(){
                            //     window.location = 'http://papihack/mglsi_news/public/index.php?action=removeEditor&id=' + event.target.id
                            // }, 1000)
                        }
                        else
                            event.preventDefault()

                    })
        })
    }
</script>
