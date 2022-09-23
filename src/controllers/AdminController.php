<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/entity/Comment.php');
require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');

class AdminController 
{
    public function administration() : void
    {
        if(isset($_SESSION['userInformations']) AND $_SESSION['userInformations']['role'] = 'admin') {
            $commentModel = new CommentModel();
            $pendingComments = $commentModel->getPendingComments();

            $postModel = new PostModel();
            $posts = $postModel->getPosts();

            require('templates/admin.php');
        } else {
            $_SESSION['error'] = 'Accès interdit, vous ne possèdez pas les droits administrateur.';
            header('Location: index.php');
        }
     
    }

    public function commentValidate($id) : void 
    {
        $commentModel = new CommentModel();
        $validateComment = $commentModel->commentValidation($id);

        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été validé.';
            header('Location: index.php?action=admin');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être validé.';
            header('Location: index.php?action=admin');
        }
       
    }

    public function commentRestaurate($id) : void 
    {
        $commentModel = new CommentModel();
        $validateComment = $commentModel->commentValidation($id);

        if($validateComment) {
            $_SESSION['success'] = 'Le commentaire a été validé.';
            header('Location: index.php?action=moderatedcomment');
        }else{
            $_SESSION['error'] = 'Le commentaire n\a pas pu être validé.';
            header('Location: index.php?action=moderatedcomment');
        }
       
    }

    public function commentDelete($id) : void 
    {
        $commentModel = new CommentModel();
        $deleteComment = $commentModel->commentModeration($id);

        if($deleteComment) {
            $_SESSION['success'] = 'Le commentaire a été modéré et ne sera pas affiché sur l\'article.';
            header('Location: index.php?action=admin');
        }else{
            $_SESSION['error'] = 'La modération du commentaire a échouée.';
            header('Location: index.php?action=admin');
        }
       
    }

    public function moderatedComment() : void 
    {
        $commentModel = new CommentModel();
        $moderatedComments = $commentModel->moderatedListing();
        require('templates/moderatedComments.php');
    }



}