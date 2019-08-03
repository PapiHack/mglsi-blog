<div id="menu">
	<h1>Mon espace</h1><hr width="60%">
	<ul>
		<li><a href="index.php?action=login">Accueil</a></li>
		<li><a href="index.php?action=editAdmin&id=<?= SessionManager::get('user')->getId() ?>">Mon profil</a></li>
		<li><a href="index.php">Allez au blog</a></li>
		<li><a href="index.php?action=writeArticle">Ecrire un nouvel article</a></li>
		<li><a href="index.php?action=gestionArticle">Gestion des articles</a></li>
		<li><a href="index.php?action=gestionCategorie">Gestion des catégories</a></li>
		<li><a href="index.php?action=gestionMembre">Gestion des membres</a></li>
		<li><a href="index.php?action=gestionAdmin">Gestion des admins</a></li>
	</ul>
	<h1>Partir</h1><hr width="60%">
	<ul>
		<li> <a href="index.php?action=logout">Se déconnecter</a> </li>
	</ul>
</div>