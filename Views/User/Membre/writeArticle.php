<?php $title = 'Mon espace perso'; 

$entete = 'Mon espace perso';

ob_start();

?>

<div id="contenu">
<?php if(isset($error)) {  ?>
    <h3 style="color: red"> <?= $error ?> </h3>
<?php } else if(isset($success)) { ?>
    <h3 style="color: green"> <?= $success ?> </h3>
<?php } ?>
    <form action="index.php?action=storeWrittedArticle" method="POST">
        <fieldset>
        <legend><h3>Rédaction d'un article</h3></legend>
            <table>
                <tr>
                    <td> <label for="titre">Titre</label> </td>
                    <td> <input type="text" name="titre" id="titre" placeholder="Le titre de l'article"/> </td>
                </tr>
                <tr>
                    <td> <label for="contenu">Contenu</label> </td>
                    <td> <textarea name="contenu" id="contenu" cols="50" rows="10">Le contenu de l'article</textarea> </td>
                </tr>
                <tr>
                    <td><label for="categorie">Categorie</label></td>
                    <td>
                        <select name="categorie" id="categorie">
                            <?php foreach(SessionManager::get('categories') as $categorie) { ?>
                                <option value="<?= $categorie->getId()?>"> <?= $categorie->getLibelle() ?> </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> <input type="submit" value="Publier"> <button id="cancel">Annuler</button> </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>

<script>
    document.getElementById('cancel').addEventListener('click', function(event){
        event.preventDefault()
        window.location.replace('http://localhost/mglsi_news/public/index.php?action=connexion')
    })
</script>

<?php $content = ob_get_clean(); 

require_once('../Views/User/layoutMembre.php');

?>