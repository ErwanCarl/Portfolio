<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\model\CommentModel;
use App\model\PostModel;
use App\entity\User;

class AdminHandler 
{
    public function adminAccessCheck() : void 
    {
        if(isset($_SESSION['userInformations']) && $_SESSION['userInformations']['role'] === 'admin' && isset($_SESSION['Connection'])) {
            $commentModel = new CommentModel();
            $pendingComments = $commentModel->getPendingComments();

            $postModel = new PostModel();
            $posts = $postModel->getPosts();

            require(TEMPLATE_DIR.'/admin.php');
        } else if(!isset($_SESSION['Connection'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour administrer le site.';
            header('Location: /');
        } else {
            $_SESSION['error'] = 'Accès interdit, vous ne possèdez pas les droits administrateur.';
            header('Location: /');
        }
    }

    public function roleModificationCheck(bool $roleChange) : void 
    {
        if($roleChange) {
            $_SESSION['success3'] = 'Le changement de rôle a été effectué.';
            header('Location: /admin#permissions');
        }else{
            $_SESSION['error3'] = 'Le changement de rôle a échoué.';
            header('Location: /admin#permissions');
        }
    }

    public function userFoundCheck(?User $userFound) : void 
    {
        if(isset($userFound)) {
            $_SESSION['userChange']['username'] = $userFound->getUsername();
            $_SESSION['userChange']['role'] = $userFound->getRole();
            header('Location: /admin#permissions');
        }else{
            $_SESSION['error3'] = 'Aucun utilisateur trouvé avec ce pseudo.';
            header('Location: /admin#permissions');
        }
    }

    public function adminDeleteCommentCheck(bool $deleteComment) : void 
    {
        if($deleteComment) {
            $_SESSION['success'] = 'Le commentaire a été modéré et ne sera pas affiché sur l\'article.';
            header('Location: /admin');
        }else{
            $_SESSION['error'] = 'La modération du commentaire a échouée.';
            header('Location: /admin');
        }
    }

    public function adminRestaurateCommentCheck(bool $validateComment) : void 
    {
        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été restauré et sera désormais visible sur l\'article.';
            header('Location: /moderatedcomment/1');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être restauré.';
            header('Location: /moderatedcomment/1');
        }
    }

    public function adminValidateCommentCheck(bool $validateComment) : void 
    {
        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été validé.';
            header('Location: /admin');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être validé.';
            header('Location: /admin');
        }
    }
}
