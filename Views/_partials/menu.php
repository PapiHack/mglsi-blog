<div id="menu">
	<h1>Catégories</h1><hr width="60%">
	<ul>
		<li><a href="index.php">Tout</a></li>
		<?php foreach ($this->allCategories as $categorie): ?>
			<li><a href="index.php?categorie=<?= $categorie->getId() ?>"><?= $categorie->getLibelle() ?></a></li>
		<?php endforeach ?>
	</ul>
	<h1>Espace Membre</h1><hr width="60%">
	<ul>
		<?php if(SessionManager::get('user')) { ?>
		<li><a href="index.php?action=login">Mon Espace perso</a></li>
		<li><a href="index.php?action=logout">Se déconnecter</a></li>
		<?php } else { ?>
			<li> <a href="index.php?action=inscription">S'inscrire</a> </li>
			<li> <a href="index.php?action=connexion">Se connecter</a> </li>
		<?php } ?>
	</ul>
</div>