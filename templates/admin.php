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
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Fin bootstrap -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="responsive.css">
		
	</head>

	<body>

		<?php include('header.php'); ?>

        <h1>Page d'administration</h1>

        <div class="accounts_validation">
            <?php
//  Récupérer les infos du visiteur qui crée le compte pour pouvoir le valider ou supprimer de BDD et donc page admin
//  Utiliser validate_account et role pour recevoir en front + select pour attribuer role user/admin
//  + bouton check / croix pour SET validation = 1 et role = choix à ajouter
                foreach($pendingAccounts as $pendingAccount) {
            ?>
                    <div class ="account">
                        <?php echo htmlspecialchars($pendingAccount->getLogo()); ?>
                    </div>

                    <div class ="account">
                        <?php echo htmlspecialchars($pendingAccount->getUsername()); ?>
                    </div>
                    
                    <div class ="account">
                        <?php echo htmlspecialchars($pendingAccount->getNickname()." ".$pendingAccount->getName()); ?>
                    </div>

                    <div class ="account">
                        <?php echo htmlspecialchars($pendingAccount->getMail()); ?>
                    </div>

            <?php
                }
            ?>
        </div>

        <div class="comments_validation">
            <?php
//  Set en BDD comment validation = 1 ou est supprimmer de BDD et de l'affichage en admin
//  + bouton check / croix pour SET validation = 1 et role = choix à ajouter
                foreach($pendingComments as $pendingComment) {
            ?>
                    <div class ="comment">
                        <?php echo htmlspecialchars($pendingComment->getAuthor()); ?>
                    </div>
                    
                    <div class ="comment">
                        <?php echo htmlspecialchars($pendingComment->getContent()); ?>
                    </div>

            <?php
                }
            ?>
        </div>

        <?php include('footer.php'); ?>

    </body>
</html>