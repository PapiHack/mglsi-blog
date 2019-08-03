<?php $title = 'Inscription MGLSI NEWS'; 

$entete = SessionManager::get('user')->getStatut() === 'user' ? 'Mon espace perso' : 'Espace Admin';

ob_start();

?>

<div id="contenu">
<?php if(isset($registerValid)) { ?>
    <div>
        <h3 style="color: red;"> <?= $registerValid['error'] ?> </h3>
    </div>
<?php } if(isset($success)) { ?>
    <div>
        <h3 style="color: green;"> <?= $success?> </h3>
    </div>
<?php } ?>

    <form <?php if(isset($user)){ ?> action="index.php?action=updateUser&id=<?= $user->getId() ?>" <?php } ?> action="index.php?action=register" class="form-vertical" method="POST">
        <div class="form-group">
            <legend><?= isset($user) ? 'Edition' : 'Ajout' ?> d'un <?= SessionManager::get('add') == 'admin' ? 'admin' : 'éditeur' ?></legend>
            <?php if(isset($user) && $user->getId() == SessionManager::get('user')->getId()) {
                $tokenAdmin = $this->tokenManager->getTokenByUser($user->getId());
             ?>
                <?php if(isset($tokenAdmin)) { ?>
                            <a href="index.php?action=revokeToken&id=<?= $user->getId() ?>" class="btn btn-danger"> <i class="fa fa-lock"></i>  Révoquer mon token</a><br>
                        <?php } else { ?>
                            <a href="index.php?action=generateToken&id=<?= $user->getId() ?>" class="btn btn-success"> <i class="fa fa-key"></i>  Générer mon token</a>
                        <?php } 
                        
            }?> 
        </div>

        <input type="hidden" name="statut" value="<?= SessionManager::get('add') == 'admin' ? 'admin' : 'user'?>"/>

        <div class="row">
            <div class="form-group">
                <label for="nom" class="col-lg-4">Nom</label>
                <div class="col-lg-6">
<input type="text" name="nom" class="form-control" <?php if(isset($user)) { ?> value="<?= $user->getNom() ?>" <?php } ?> value="<?= isset($registerValid['data']['nom']) ? $registerValid['data']['nom'] : '' ?>" required id="nom" placeholder="Votre nom..."/>
                </div> 
            </div>
        </div> <br>
        
        <div class="row">
            <div class="form-group">
                <label for="prenom" class="col-lg-4">Prenom</label>
                <div class="col-lg-6">
                    <input type="text" name="prenom" <?php if(isset($user)) { ?> value="<?= $user->getPrenom() ?>" <?php } ?> class="form-control" value="<?= isset($registerValid['data']['prenom']) ? $registerValid['data']['prenom'] : '' ?>" required id="prenom" placeholder="Votre prenom..."/>
                </div> 
            </div>
        </div> <br>
        
        <div class="row">
            <div class="form-group">
                <label for="pseudo" class="col-lg-4">Pseudo</label>
                <div class="col-lg-6">
                    <input type="text" name="pseudo" <?php if(isset($user)) { ?> value="<?= $auth->getLogin() ?>" <?php } ?> class="form-control" value="<?= isset($registerValid['data']['pseudo']) ? $registerValid['data']['pseudo'] : '' ?>" required id="pseudo" placeholder="Votre pseudo..."/>
                </div> 
            </div>
        </div> <br>
        
        <div class="row">
            <div class="form-group">
                <label for="mail" class="col-lg-4">Adresse email</label>
                <div class="col-lg-6">
                    <input type="text" name="mail" <?php if(isset($user)) { ?> value="<?= $user->getMail() ?>" <?php } ?> class="form-control" value="<?= isset($registerValid['data']['mail']) ? $registerValid['data']['mail'] : '' ?>" required id="mail" placeholder="Votre adresse email..."/>
                </div> 
            </div>
        </div> <br>
        
        <div class="row">
            <div class="form-group">
                <label for="mdp" class="col-lg-4">Mot de passe</label>
                <div class="col-lg-6">
                    <input type="password" <?php if(isset($user)) { ?> value="<?= $auth->getMdp() ?>" <?php } ?> name="mdp" class="form-control" value="<?= isset($registerValid['data']['mdp']) ? $registerValid['data']['mdp'] : '' ?>" required id="mdp" placeholder="Votre mot de passe..."/>
                </div> 
            </div>
        </div> <br>
        
        <div class="row">
            <div class="form-group">
                <label for="cmdp" class="col-lg-4">Confirmer mot de passe</label>
                <div class="col-lg-6">
                    <input type="password" name="cmdp" <?php if(isset($user)) { ?> value="<?= $auth->getMdp() ?>" <?php } ?> class="form-control" value="<?= isset($registerValid['data']['cmdp']) ? $registerValid['data']['cmdp'] : '' ?>" required id="cmdp" placeholder="Confirmer votre mot de passe..."/>
                </div> 
            </div>
        </div> <br>

        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-4">
                <input type="submit" value="Validez" class="btn btn-success">
                <?php if($_GET['action'] == 'editAdmin' || $_GET['action'] == 'addAdmin'){ ?> <a href="index.php?action=gestionAdmin" class="btn btn-danger">Annuler</a>
                <?php } else { ?> <a href="index.php?action=gestionMembre" class="btn btn-danger">Annuler</a> <?php } ?>
            </div>
        </div>
    </form>
</div>

<?php

$content = ob_get_clean();

if(SessionManager::get('user')->getStatut() === 'user')
{
    require_once('../Views/User/layoutMembre.php'); 
}
else
{
    require_once('../Views/User/layoutAdmin.php');
}

?>