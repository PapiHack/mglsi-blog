<?php $title = 'Login MGLSI NEWS'; 

$entete = 'Connexion à M1GLSI - NEWS';

ob_start();

?>

<div id="contenu">
<?php  if(isset($error)) { ?>

    <div>
        <h3 style="color: red;"> <?= $error ?> </h3>
    </div>

    <?php } ?>
    <form action="index.php?action=login" method="POST">
        <table>
            <tr>
                <td> <label for="pseudo">Pseudo</label> </td>
                <td> <input type="text" name="pseudo" required id="pseudo" placeholder="Votre pseudo ici"/> </td>
            </tr>
            <tr>
                <td> <label for="mdp">Mot de passe</label> </td>
                <td> <input type="password" name="mdp" required id="mdp" /> </td>
            </tr>
            <tr>
                <td> </td>
                <td> <input type="submit" value="Se connecter"> <button id="cancel">Annuler</button> </td>
            </tr>
        </table>
    </form>
</div>

<script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('http://localhost/mglsi_news/public/index.php')
    })
</script>

<?php

$content = ob_get_clean(); 

require_once('../Views/layout.php');

?>