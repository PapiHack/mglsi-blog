<?php $title = 'Login MGLSI NEWS';

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu" class="col-lg-12">
    <?php if (isset($error)) { ?>

        <div>
            <h3 style="color: red;"> <?= $error ?> </h3>
        </div>

    <?php }  ?>
    <form action="<?= URI ?>login" method="POST" class="form-vertical">
        <div class="form-group">
            <legend>Authentification</legend>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="pseudo" class="col-lg-3">Pseudo</label>
                <div class="col-lg-6">
                    <input type="text" name="pseudo" class="form-control" required id="pseudo" placeholder="Votre pseudo..." />
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="form-group">
                <label for="mdp" class="col-lg-3">Mot de passe</label>
                <div class="col-lg-6">
                    <input type="password" placeholder="Votre mot de passe..." class="form-control" name="mdp" required id="mdp" />
                </div>
            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <input type="submit" value="Se connecter" class="btn btn-success" />
                <button id="cancel" class="btn btn-danger">Annuler</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('cancel').addEventListener('click', function(event) {
        event.preventDefault()
        window.location.replace('/mglsi-blog/index')
    })
</script>

<?php

$content = ob_get_clean();

require_once('../Views/layout.php');

?>