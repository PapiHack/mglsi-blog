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
		<li> <a href="index.php?action=inscription">S'inscrire</a> </li>
		<li> <a href="index.php?action=connexion">Se connecter</a> </li>
	</ul>
</div>