<div id="menu">
	<h1>Catégories</h1><hr width="60%">
	<ul>
		<li><a href="<?= URI?>index">Tout</a></li>
		<?php foreach ($this->allCategories as $categorie): ?>
			<li><a href="<?= URI?>categorie/<?= $categorie->getId() ?>"><?= $categorie->getLibelle() ?></a></li>
		<?php endforeach ?>
	</ul>
	<h1>Espace Membre</h1><hr width="60%">
	<ul>
		<?php if(SessionManager::get('user')) { ?>
		<li><a href="<?= URI?>login">Mon Espace perso</a></li>
		<li><a href="<?= URI?>logout">Se déconnecter</a></li>
		<?php } else { ?>
			<li> <a href="<?= URI?>inscription">S'inscrire</a> </li>
			<li> <a href="<?= URI?>connexion">Se connecter</a> </li>
		<?php } ?>
	</ul>
</div>
