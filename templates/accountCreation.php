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
    <form action="/connection" method="post">
        <h2>Connexion</h2>

        <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"/>

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
        <div class="lost_password">
            <button type="button" onclick="window.location='/passwordlandingpage'" class="btn btn-secondary mb-2">Mot de passe oublié</button>
        </div>
    </form>
</div>


<!-- ------------------------ Creation system -------------------- --> 

<div class="form_contact" id="account_create">
    <form action="/accountsubmit" method="post">
        <h2>Création de compte utilisateur</h2>

        <div class="form_case">
            <label for="name">Nom</label>
            <input required type="text" name="name" id="name" maxlength="50">
        </div>

        <div class="form_case">
            <label for="nickname">Prénom</label>
            <input required type="text" name="nickname" id="nickname" maxlength="50">
        </div>

        <div class="form_case">
            <label for="username">Pseudo</label>
            <input required type="text" name="username" id="username" maxlength="100">
        </div>

        <div class="form_case">
            <label for="mail">Email</label>
            <input required type="email" name="mail" id="mail" maxlength="255">
        </div>

        <div class="form_case">
            <label for="phonenumber">Téléphone</label>
            <input type="tel" name="phonenumber" id="phonenumber" maxlength="20" pattern="[0-9]{10,20}">
        </div>

        <div class="form_case">
            <label for="password">Mot de passe</label>
            <input required type="password" name="password" id="password" minlength="8" maxlength="255" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,255}$" TITLE="Le mot de passe doit contenir au minimum 8 caractères, une lettre minuscule, une lettre majuscule et un chiffre.">
        </div>

        <div class="form_button">
            <button type="submit">Créer le compte</button>
        </div>
    </form>
</div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
