<?php

/* To have a strict use of variable types */
declare(strict_types=1);



class AdminHandler 
{
    public function roleModificationCheck(bool $roleChange) : void 
    {
        if($roleChange) {
            $_SESSION['success3'] = 'Le changement de rôle a été effectué.';
            header('Location: index.php?action=admin#permissions');
        }else{
            $_SESSION['error3'] = 'Le changement de rôle a échoué.';
            header('Location: index.php?action=admin#permissions');
        }
    }

    public function userFoundCheck(?User $userFound) : void 
    {
        if(isset($userFound)) {
            $_SESSION['userChange']['username'] = $userFound->getUsername();
            $_SESSION['userChange']['role'] = $userFound->getRole();
            header('Location: index.php?action=admin#permissions');
        }else{
            $_SESSION['error3'] = 'Aucun utilisateur trouvé avec ce pseudo.';
            header('Location: index.php?action=admin#permissions');
        }
    }

    public function adminDeleteCommentCheck(bool $deleteComment) : void 
    {
        if($deleteComment) {
            $_SESSION['success'] = 'Le commentaire a été modéré et ne sera pas affiché sur l\'article.';
            header('Location: index.php?action=admin');
        }else{
            $_SESSION['error'] = 'La modération du commentaire a échouée.';
            header('Location: index.php?action=admin');
        }
    }

    public function adminRestaurateCommentCheck(bool $validateComment) : void 
    {
        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été restauré et sera désormais visible sur l\'article.';
            header('Location: index.php?action=moderatedcomment');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être restauré.';
            header('Location: index.php?action=moderatedcomment');
        }
    }

    public function adminValidateCommentCheck(bool $validateComment) : void 
    {
        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été validé.';
            header('Location: index.php?action=admin');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être validé.';
            header('Location: index.php?action=admin');
        }
    }
}