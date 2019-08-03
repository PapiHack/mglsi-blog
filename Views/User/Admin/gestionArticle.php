<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<h1>Liste des articles</h1>
<p style="font-size: 1.5em;"><a href="index.php?action=writeArticle" class="btn btn-success"><i class="fa fa-edit"></i>  Ecrire un nouvel article</a></p>
    <br>
    <?php if(empty($articles)){ ?>
    <h2>Vous n'avez pas encore d'article(s).</h2>
    <?php } else{ ?>
        <table id="tab" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Titre</b></th>
                    <th><b>Auteur</b></th>
                    <th><b>Date de publication</b></th>
                    <th><b>Opérations</b></th>
                </tr> 
            </thead>    

            <tbody>
                <?php foreach($articles as $article) {?>
                    <tr>
                        <td><?= $article->getTitre() ?></td>
                        <?php $auteur = $this->userManager->get($article->getAuteur());  ?>
                        <td><?= $auteur ? $auteur->getPrenom().' '.$auteur->getNom() : 'Inconnue' ?></td>
                        <td> <?= $article->getDateCreation() ?> </td>
                        <td>
                            <a href="index.php?action=details&id=<?= $article->getId() ?>" class="btn btn-primary" title="Détails"><i class="fa fa-book"></i></a>
                            <a href="index.php?action=editArticle&id=<?= $article->getId() ?>" class="btn btn-warning" title="Editer"><i class="fa fa-edit"></i></a>
                            <button type="button" id="<?= $article->getId() ?>" class="btn btn-danger sup"><i class="fa fa-trash"></i></button>             
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

        $('.sub').on('click', function(event){
            alert(event.target)
        })
    })

    var articles = document.getElementsByClassName('sup')
    for(var i = 0; i < articles.length; i++)
    {
        articles[i].addEventListener('click', function(event){
                Swal.fire({
                    title: 'Voulez vous vraiment supprimer cet article ?',
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
                                title: 'Article supprimé !',
                                showConfirmButton: false,
                                timer: 1500,
                                })

                            setTimeout(function(){
                                window.location = 'http://papihack/mglsi_news/public/index.php?action=removeArticle&id=' + event.target.id
                            }, 1000)
                        }
                        else
                            event.preventDefault()

                    })
        })
    }
</script>