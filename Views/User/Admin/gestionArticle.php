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