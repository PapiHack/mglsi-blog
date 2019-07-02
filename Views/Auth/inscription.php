<?php $title = 'Login MGLSI NEWS'; 

$entete = 'Inscription à M1GLSI - NEWS';

ob_start();

?>

<div id="contenu">
    <form action="" method="POST">
        <table>
            <tr>
                <td> <label for="Nom">Nom</label> </td>
                <td> <input type="text" name="Nom" id="Nom" placeholder="Votre nom ici"/> </td>
            </tr>
            <tr>
                <td> <label for="prenom">Prenom</label> </td>
                <td> <input type="text" name="prenom" id="prenom" placeholder="Votre prenom ici"/> </td>
            </tr>
            <tr>
                <td> <label for="pseudo">Pseudo</label> </td>
                <td> <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo ici"/> </td>
            </tr>
            <tr>
                <td> <label for="mail">Adresse email</label> </td>
                <td> <input type="text" name="mail" id="mail" placeholder="Votre adresse email ici"/> </td>
            </tr>
            <tr>
                <td> <label for="mdp">Mot de passe</label> </td>
                <td> <input type="password" name="mdp" id="mdp"/> </td>
            </tr>
            <tr>
                <td> <label for="cmdp">Confirmer mot de passe</label> </td>
                <td> <input type="password" name="Mot de passe" id="Mot de passe"/> </td>
            </tr>
            <tr>
                <td> </td>
                <td> <input type="submit" value="S'inscrire"> <button id="cancel">Annuler</button> </td>
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