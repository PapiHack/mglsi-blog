<?php $title = 'Inscription MGLSI NEWS';

$entete = 'Site d\'actualité du MGLSI';

ob_start();

?>

<div id="contenu">
    <?php if (isset($registerValid)) { ?>
        <div>
            <h3 style="color: red;"> <?= $registerValid['error'] ?> </h3>
        </div>
    <?php }
    if (isset($success)) { ?>
        <div>
            <h3 style="color: green;"> <?= $success ?> </h3>
        </div>
    <?php } ?>
    <form action="<?= URI ?>register" class="form-vertical" method="POST">
        <div class="form-group">
            <legend>Inscription à l'édition</legend>
        </div>

        <input type="hidden" name="statut" value="user" />

        <div class="row">
            <div class="form-group">
                <label for="nom" class="col-lg-4">Nom</label>
                <div class="col-lg-6">
                    <input type="text" name="nom" class="form-control" value="<?= isset($registerValid['data']['nom']) ? $registerValid['data']['nom'] : '' ?>" required id="nom" placeholder="Votre nom..." />
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="form-group">
                <label for="prenom" class="col-lg-4">Prenom</label>
                <div class="col-lg-6">
                    <input type="text" name="prenom" class="form-control" value="<?= isset($registerValid['data']['prenom']) ? $registerValid['data']['prenom'] : '' ?>" required id="prenom" placeholder="Votre prenom..." />
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="form-group">
                <label for="pseudo" class="col-lg-4">Pseudo</label>
                <div class="col-lg-6">
                    <input type="text" name="pseudo" class="form-control" value="<?= isset($registerValid['data']['pseudo']) ? $registerValid['data']['pseudo'] : '' ?>" required id="pseudo" placeholder="Votre pseudo..." />
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="form-group">
                <label for="mail" class="col-lg-4">Adresse email</label>
                <div class="col-lg-6">
                    <input type="text" name="mail" class="form-control" value="<?= isset($registerValid['data']['mail']) ? $registerValid['data']['mail'] : '' ?>" required id="mail" placeholder="Votre adresse email..." />
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="form-group">
                <label for="mdp" class="col-lg-4">Mot de passe</label>
                <div class="col-lg-6">
                    <input type="password" name="mdp" class="form-control" value="<?= isset($registerValid['data']['mdp']) ? $registerValid['data']['mdp'] : '' ?>" required id="mdp" placeholder="Votre mot de passe..." />
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="form-group">
                <label for="cmdp" class="col-lg-4">Confirmer mot de passe</label>
                <div class="col-lg-6">
                    <input type="password" name="cmdp" class="form-control" value="<?= isset($registerValid['data']['cmdp']) ? $registerValid['data']['cmdp'] : '' ?>" required id="cmdp" placeholder="Confirmer votre mot de passe..." />
                </div>
            </div>
        </div> <br>

        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-4">
                <input type="submit" value="S'inscrire" class="btn btn-success" />
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