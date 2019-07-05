<?php 
SessionManager::start();

$title = 'Mon espace perso'; 

$entete = 'Espace Admin';

ob_start();

?>

<div id="contenu">
    <h1>Bienvenue <?php echo SessionManager::get('user')->getPrenom().' '.SessionManager::get('user')->getNom(); ?> !</h1>
</div>

<?php $content = ob_get_clean(); 

require_once('../Views/User/layoutAdmin.php');

?>