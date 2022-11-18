<?php ob_start();?>

<?php 
	if(isset($_SESSION['error'])){
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

<div id="forbidden_page" class="text-center text-secondary">

    <h1 class="display-1 text-danger font-title font-weight-bold">403</h1>
    <h3 class="display-4 font-title">L'accès à la page a été refusé.</h3>

    <div>
        L'accès à la page que vous tentez d'afficher a été refusé.
    </div>
    <div class="back_home">
        Vous pouvez revenir à <a href="/">l'accueil</a>.
    </div>
</div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
