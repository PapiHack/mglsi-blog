<div id="menu">
	<ul>
		<li><a href="<?= URI?>index">Acceuil</a></li>
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
