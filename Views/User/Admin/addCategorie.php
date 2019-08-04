<?php $title = 'Espace Admin';

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
<?php if(isset($error)) {  ?>
    <h3 style="color: red"> <?= $error ?> </h3>
<?php } else if(isset($success)) { ?>
    <h3 style="color: green"> <?= $success ?> </h3>
<?php } ?>
    <form <?php if(isset($categorie)) { ?> action="<?= URI?>updateCategorie" <?php } ?> action="<?= URI?>storeCategorie" class="form-vertical" method="POST">
        <fieldset>
        <legend><h3><?= isset($categorie) ? 'Edition' : 'Ajout' ?> de catégorie</h3></legend>
            <?php if(isset($categorie)) { ?> <input type="hidden" name="id_categorie" value="<?= $categorie->getId() ?>">  <?php } ?>
        <div class="row">
            <div class="form-group">
                <label for="libelle" class="col-lg-2">Libellé</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" <?php if(isset($categorie)) { ?> value="<?= $categorie->getLibelle() ?>" <?php } ?>name="libelle" id="libelle" placeholder="Le libellé de l'article"/>
                </div>
            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <input type="submit" value="Ajouter" class="btn btn-success"/>
            </div>
        </div>
        </fieldset>
    </form>
</div>

<!-- <script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('http://localhost/mglsi_news/public/index.php?action=gestionCategorie')
    })
</script> -->

<?php $content = ob_get_clean();

require_once('../Views/User/layoutAdmin.php');

?>
