<?php ob_start();?>

<?php 
	if(isset($user)) { 
?>
        <div class="form_password">
            <form action="index.php?action=passwordmodify" method="post">
                <h2>Changement de mot de passe</h2>

                <div class="form_case">
                    <input type="hidden" name="token" id="token" value="<?php echo htmlspecialchars($user->getAccountKey()); ?>">
                </div>

                <div class="form_case">
                    <input type="hidden" name="email" id="email" value="<?php echo htmlspecialchars($user->getMail()); ?>">
                </div>

                <div class="form_case">
                    <label for="password">Nouveau mot de passe</label>
                    <input required type="password" name="password" id="password">
                </div>

                <div class="form_case">
                    <label for="passwordconfirmation">Confirmer le mot de passe</label>
                    <input required type="password" name="passwordconfirmation" id="passwordconfirmation">
                </div>

                <div class="form_button">
                    <button type="submit">Confirmer</button>
                </div>
            </form>
        </div>

<?php 
	} else { 
?>
        <div class="form_password">
            <form action="index.php?action=sendpasswordmail" method="post">
                <h2>Récupération de mot de passe</h2>

                <div class="form_case">
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email">
                </div>

                <div class="form_button">
                    <button type="submit">Confirmer</button>
                </div>
            </form>
        </div>
<?php 
	}
?>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>