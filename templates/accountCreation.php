<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Erwan Carlini">
		<meta name="description" content="">
		<meta name="copyright" content="Erwan Carlini">
		<meta name="keywords" content="">
		<title>Erwan Carlini - Portfolio</title>
		<link rel="icon" type="" href="">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="responsive.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
	</head>

	<body>

	    <?php include('header.php'); ?>

<!-- ------------------------ Connection system -------------------- --> 

        <?php 
			if(isset($_SESSION['FlashFailedConnection'])) { 
		?>
				<div class="flash_connection">
					<?php 
                        $message = $_SESSION['FlashFailedConnection'];
                        unset($_SESSION['FlashFailedConnection']);
                        echo $message;
                     ?>
				</div>
		<?php 
		} 
		?>

        <div class="form_contact">
            <form action="index.php?action=connection" method="post">
                <h2>Connexion</h2>

                <div class="form_case">
                    <label for="mail">Email</label>
                    <input required type="email" name="mail" id="mail">
                </div>

                <div class="form_case">
                    <label for="password">Mot de passe</label>
                    <input required type="password" name="password" id="password">
                </div>

                <div class="form_button">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
        </div>

<!-- ------------------------ Creation system -------------------- --> 

        <?php 
			if(isset($_SESSION['FlashExistingPseudo'])) { 
		?>
				<div class="flash_connection">
					<?php 
                        $message = $_SESSION['FlashExistingPseudo'];
                        unset($_SESSION['FlashExistingPseudo']);
                        echo $message;
                     ?>
				</div>
		<?php 
		    } elseif (isset($_SESSION['FlashExistingMail'])) {
        ?>
                <div class="flash_connection">
                    <?php
                        $message = $_SESSION['FlashExistingMail'];
                        unset($_SESSION['FlashExistingMail']);
                        echo $message;
                    ?>
                </div>
        <?php
        }
		?>

        <div class="form_contact">
            <form action="index.php?action=accountsubmit" method="post">
                <h2>Création de compte utilisateur</h2>

                <div class="form_case">
                    <label for="name">Nom</label>
                    <input required type="text" name="name" id="name">
                </div>

                <div class="form_case">
                    <label for="nickname">Prénom</label>
                    <input required type="text" name="nickname" id="nickname">
                </div>

                <div class="form_case">
                    <label for="username">Pseudo</label>
                    <input required type="text" name="username" id="username">
                </div>

                <div class="form_case">
                    <label for="mail">Email</label>
                    <input required type="email" name="mail" id="mail">
                </div>

                <div class="form_case">
                    <label for="phonenumber">Téléphone</label>
                    <input required type="tel" name="phonenumber" id="phonenumber" pattern="[0-9]{10}">
                </div>

                <div class="form_case">
                    <label for="password">Mot de passe</label>
                    <input required type="password" name="password" id="password">
                </div>

                <div class="form_button">
                    <button type="submit">Créer le compte</button>
                </div>
            </form>
        </div>

        <?php include('footer.php'); ?>

    </body>
</html>