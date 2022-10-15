<?php ob_start();?>

<div class="form_contact">
	<form action="index.php?action=inscriptionvalidation" method="post">
		<h2>Validation de compte</h2>

		<div class="form_case">
			<label for="email">Email</label>
			<input required type="email" name="email" id="email">
		</div>

		<div class="form_case">
            <label for="password">Mot de passe</label>
            <input required type="password" name="password" id="password">
        </div>
	
		<div class="form_button">
			<button type="submit">Envoyer</button>
		</div>
	</form>
</div>








<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>