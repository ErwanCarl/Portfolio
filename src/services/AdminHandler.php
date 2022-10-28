<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');

class AdminHandler 
{
    public function adminAccessCheck() : void 
    {
        if(isset($_SESSION['userInformations']) && $_SESSION['userInformations']['role'] === 'admin' && isset($_SESSION['Connection'])) {
            $commentModel = new CommentModel();
            $pendingComments = $commentModel->getPendingComments();

            $postModel = new PostModel();
            $posts = $postModel->getPosts();

            require('templates/admin.php');
        } else if(!isset($_SESSION['Connection'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour administrer le site.';
            header('Location: index.php');
        } else {
            $_SESSION['error'] = 'Accès interdit, vous ne possèdez pas les droits administrateur.';
            header('Location: index.php');
        }
    }

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
