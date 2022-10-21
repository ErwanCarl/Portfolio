<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class PostHandler {

    public function deleteCheck(bool $postDelete) : void 
    {
        if($postDelete) {
            $_SESSION['success2'] = 'L\'article a bien été supprimé.';
            header('Location:index.php?action=admin#gestionArticle');
        } else {
            $_SESSION['error2'] = 'La suppression de l\'article a échouée.';
            header('Location:index.php?action=admin#gestionArticle');
        }
    }



}