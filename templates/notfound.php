<?php ob_start();?>

<div id="not_found_page" class="text-center text-secondary">

    <h1 class="display-1 text-danger font-title font-weight-bold">404</h1>
    <h3 class="display-4 font-title">Page non trouvée.</h3>

    <div>
        La page que vous tentez d'afficher n'existe pas ou une autre erreur s'est produite.
    </div>
    <div class="back_home">
        Vous pouvez revenir à <a href="/">l'accueil</a>.
    </div>
</div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
