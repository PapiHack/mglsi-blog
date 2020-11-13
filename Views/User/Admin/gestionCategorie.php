<?php $title = 'Espace Admin';

$entete = 'Site d\'actualité du MGLSI';

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
                        <a href="<?= URI?>editCategorie/<?= $categorie->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>
                        <button type="button" id="<?= $categorie->getId() ?>" class="btn btn-danger sup"><i class="fa fa-trash"></i></button>
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

    var categories = document.getElementsByClassName('sup')
    for(var i = 0; i < categories.length; i++)
    {
        categories[i].addEventListener('click', function(event){
                Swal.fire({
                    title: 'Voulez vous vraiment supprimer cette catégorie ?',
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
                                title: 'Catégorie supprimé !',
                                showConfirmButton: false,
                                timer: 1500,
                                })

                            setTimeout(function(){
                                window.location = '/mglsi-blog/removeCategorie/' + event.target.id
                            }, 1000)
                        }
                        else
                            event.preventDefault()

                    })
        })
    }
</script>
