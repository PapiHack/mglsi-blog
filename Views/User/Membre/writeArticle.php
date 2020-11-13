<?php $title = 'Mon espace perso';

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
<?php if(isset($error)) {  ?>
    <h3 style="color: red"> <?= $error ?> </h3>
<?php } else if(isset($success)) { ?>
    <h3 style="color: green"> <?= $success ?> </h3>
<?php } ?>
    <form <?php if(isset($article)){ ?> action="<?= URI?>updateArticle" <?php } ?> action="<?= URI?>storeWrittedArticle" method="POST">
        <fieldset>
        <legend><h3><?= isset($article) ? 'Edition' : 'Rédaction' ?> d'un article</h3></legend>
            <?php if(isset($article)) { ?> <input type="hidden" name="id_article" value="<?= $article->getId() ?>"> <?php } ?>
                <div class="row">
                    <div class="form-group">
                        <label for="titre" class="col-lg-3">Titre</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="titre" <?php if(isset($article)) { ?> value="<?= $article->getTitre() ?>" <?php } ?> id="titre" placeholder="Le titre de l'article"/>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="form-group">
                        <label for="contenu" class="col-lg-3">Contenu</label>
                        <div class="col-lg-8">
                            <textarea name="contenu" class="form-control" id="contenu" cols="70" rows="10"> <?= isset($article) ? $article->getContenu() : 'Le contenu de l\'article' ?> </textarea>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="form-group">
                        <label for="categorie" class="col-lg-3">Categorie</label>
                        <div class="col-lg-6">
                            <select name="categorie" id="categorie">
                                <?php foreach(SessionManager::get('categories') as $categorie) { ?>
                                <option value="<?= $categorie->getId()?>" <?php if(isset($article) && $categorie->getId() == $article->getCategorie()){ ?> selected <?php } ?> class="form-control"> <?= $categorie->getLibelle() ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-6">
                        <input type="submit" value="Publier" class="btn btn-success"/>
                    </div>
                </div>
            </table>
        </fieldset>
    </form>
</div>

<script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('/mglsi-blog/login')
    })
</script>

<?php $content = ob_get_clean();

if(SessionManager::get('user')->getStatut() === 'user')
{
    require_once('../Views/User/layoutMembre.php');
}
else
{
    require_once('../Views/User/layoutAdmin.php');
}

?>
