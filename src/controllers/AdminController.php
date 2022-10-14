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

    public function moderatedComment(int $page) : void 
    {
       
        $elementsNumber = 5;
        $commentModel = new CommentModel();
        $moderatedCommentsNumber = $commentModel->moderatedCommentsCount();
        $pageNumber = ceil($moderatedCommentsNumber[0]['moderatedCommentsNumber'] / $elementsNumber);

        if(isset($page) && $page > 0 && $page <= $pageNumber) {
            $currentPage = $page;
        }else{
            $currentPage = 1;
        }

        $moderatedComments = $commentModel->moderatedListing($currentPage, $elementsNumber);
        require('templates/moderatedComments.php');
    }

    public function usernameSearch(array $username) : void 
    {
        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        $userFound = $userModel->getUserSearched($username);

        if(isset($userFound)) {
            $_SESSION['userChange']['username'] = $userFound->getUsername();
            $_SESSION['userChange']['role'] = $userFound->getRole();
            header('Location: index.php?action=admin#permissions');
        }else{
            $_SESSION['error3'] = 'Aucun utilisateur trouvé avec ce pseudo.';
            header('Location: index.php?action=admin#permissions');
        }
    }

    public function changeUserRole(array $newUserRole) : void 
    {
        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        // est ce que je dois créer un new User ? Même si ici j'ai que role + username ?
        $roleChange = $userModel->modifyUserRole($newUserRole);

        if($roleChange) {
            $_SESSION['success3'] = 'Le changement de rôle a été effectué.';
            header('Location: index.php?action=admin#permissions');
        }else{
            $_SESSION['error3'] = 'Le changement de rôle a échoué.';
            header('Location: index.php?action=admin#permissions');
        }
    }

}
