<?php $title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
<?php if(isset($error)) {  ?>
    <h3 style="color: red"> <?= $error ?> </h3>
<?php } else if(isset($success)) { ?>
    <h3 style="color: green"> <?= $success ?> </h3>
<?php } ?>
    <form action="index.php?action=storeCategorie" method="POST">
        <fieldset>
        <legend><h3>Ajout de catégorie</h3></legend>
            <table>
                <tr>
                    <td> <label for="libelle">Libellé</label> </td>
                    <td> <input type="text" name="libelle" id="libelle" placeholder="Le libellé de l'article"/> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> <input type="submit" value="Ajouter"> <button id="cancel">Annuler</button> </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>

<script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('http://localhost/mglsi_news/public/index.php?action=gestionCategorie')
    })
</script>

<?php $content = ob_get_clean(); 

require_once('../Views/User/layoutAdmin.php');

?>