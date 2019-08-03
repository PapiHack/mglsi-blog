<?php $title = 'Login MGLSI NEWS';

$entete = 'Inscription à M1GLSI - NEWS';

ob_start();

?>

<div id="contenu">
<?php if(isset($registerValid)) { ?>
    <div>
        <h3 style="color: red;"> <?= $registerValid['error'] ?> </h3>
    </div>
<?php } if(isset($success)) { ?>
    <div>
        <h3 style="color: green;"> <?= $success?> </h3>
    </div>
<?php } ?>
    <form action="<?= URI?>register" method="POST">
        <table>
            <tr>
                <td> <label for="nom">Nom</label> </td>
                <td> <input type="text" name="nom" id="nom" value="<?= isset($registerValid['data']['nom']) ? $registerValid['data']['nom'] : '' ?>" placeholder="Votre nom ici"/> </td>
            </tr>
            <tr>
                <td> <label for="prenom">Prenom</label> </td>
                <td> <input type="text" name="prenom" value="<?= isset($registerValid['data']['prenom']) ? $registerValid['data']['prenom'] : '' ?>" id="prenom" placeholder="Votre prenom ici"/> </td>
            </tr>
            <tr>
                <td> <label for="pseudo">Pseudo</label> </td>
                <td> <input type="text" name="pseudo" value="<?= isset($registerValid['data']['pseudo']) ? $registerValid['data']['pseudo'] : '' ?>" id="pseudo" placeholder="Votre pseudo ici"/> </td>
            </tr>
            <tr>
                <td> <label for="mail">Adresse email</label> </td>
                <td> <input type="text" name="mail" value="<?= isset($registerValid['data']['mail']) ? $registerValid['data']['mail'] : '' ?>" id="mail" placeholder="Votre adresse email ici"/> </td>
            </tr>
            <tr>
                <td> <label for="mdp">Mot de passe</label> </td>
                <td> <input type="password" value="<?= isset($registerValid['data']['mdp']) ? $registerValid['data']['mdp'] : '' ?>" name="mdp" id="mdp"/> </td>
            </tr>
            <tr>
                <td> <label for="cmdp">Confirmer mot de passe</label> </td>
                <td> <input type="password" value="<?= isset($registerValid['data']['cmdp']) ? $registerValid['data']['cmdp'] : '' ?>" name="cmdp" id="cmdp"/> </td>
            </tr>
            <tr>
                <td> </td>
                <td> <input type="submit" value="S'inscrire"> <button id="cancel">Annuler</button> </td>
            </tr>
        </table>
        <input type="hidden" name="statut" value="user"/>
    </form>
</div>

<!-- <script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('http://localhost/mglsi_news/public/index.php')
    })
</script> -->

<?php

$content = ob_get_clean();

require_once('../Views/layout.php');

?>
