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
            <?php foreach($admins as $admin) { 

                if(!empty($tokens))
                    $tokenAdmin = $this->tokenManager->getTokenByUser($admin->getId());
            ?>

                <tr>
                    <td><?= $admin->getPrenom().' '.$admin->getNom() ?></td>
                    <td><?= $admin->getMail() ?></td>
                    <?php $userAuth = $this->authManager->getAuthByUser($admin->getId());  ?>
                    <td><?= $userAuth->getLogin() ?></td>
                    <td>
                        <a href="index.php?action=editAdmin&id=<?= $admin->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>
                        <button type="button" id="<?= $admin->getId() ?>" class="btn btn-danger sup"><i class="fa fa-trash"></i></button>
                        <?php if(isset($tokenAdmin)) { ?>
                            <a href="index.php?action=revokeToken&id=<?= $admin->getId() ?>" class="btn btn-danger"> <i class="fa fa-lock"></i>  Révoquer token</a>
                        <?php } else { ?>
                            <a href="index.php?action=generateToken&id=<?= $admin->getId() ?>" class="btn btn-success"> <i class="fa fa-key"></i>  Générer token</a>
                        <?php } ?>       
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

    function sleep(delay) {
        var start = new Date().getTime();
        while (new Date().getTime() < start + delay);
      }

    var admins = document.getElementsByClassName('sup')
    for(var i = 0; i < admins.length; i++)
    {
        admins[i].addEventListener('click', function(event){
                Swal.fire({
                    title: 'Voulez vous vraiment supprimer cet administrateur ?',
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
                                title: 'Administrateur supprimé !',
                                showConfirmButton: false,
                                timer: 1500,
                                })

                            setTimeout(function(){
                                window.location = 'http://papihack/mglsi_news/public/index.php?action=removeAdmin&id=' + event.target.id
                            }, 1000)
                        }
                        else
                            event.preventDefault()

                    })
        })
    }
</script>