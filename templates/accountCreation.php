<?php ob_start();?>

<!-- ------------------------ Connection system -------------------- --> 

<?php 
    if(isset($_SESSION['success'])) { 
?>
        <div class="alert alert-success" role="alert">
            <?php 
                $message = $_SESSION['success'];
                unset($_SESSION['success']);
                echo $message;
            ?>
        </div>
<?php 
    }elseif(isset($_SESSION['error'])) {
?>
        <div class="alert alert-danger" role="alert">
            <?php
                $message = $_SESSION['error'];
                unset($_SESSION['error']);
                echo $message;
            ?>
        </div>
<?php
}
?>

<div class="form_contact" id="connection_form">
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

<div class="form_contact" id="account_create">
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
            <input type="tel" name="phonenumber" id="phonenumber" pattern="[0-9]{10}">
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

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>