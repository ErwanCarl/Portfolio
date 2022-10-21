<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/entity/Comment.php');
require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');
require_once('src/services/AdminHandler.php');
require_once('src/services/PaginationHandler.php');


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

        $adminValidateCommentCheck = new AdminHandler();
        $adminValidateCommentCheck->adminValidateCommentCheck($validateComment);
       
    }

    public function commentRestaurate($id) : void 
    {
        $commentModel = new CommentModel();
        $validateComment = $commentModel->commentValidation($id);

        $adminRestaurateCommentCheck = new AdminHandler();
        $adminRestaurateCommentCheck->adminRestaurateCommentCheck($validateComment);
    }

    public function commentDelete($id) : void 
    {
        $commentModel = new CommentModel();
        $deleteComment = $commentModel->commentModeration($id);

        $adminDeleteCommentCheck = new AdminHandler();
        $adminDeleteCommentCheck->adminDeleteCommentCheck($deleteComment);
    }

    public function moderatedComment(int $page) : void 
    {
        $elementsNumber = 5;
        $commentModel = new CommentModel();
        $moderatedCommentsNumber = $commentModel->moderatedCommentsCount();
        $pageNumber = ceil($moderatedCommentsNumber[0]['moderatedCommentsNumber'] / $elementsNumber);

        $pagination = new PaginationHandler();
        $currentPage = $pagination->pagination($page, $pageNumber);

        $moderatedComments = $commentModel->moderatedListing($currentPage, $elementsNumber);
        require('templates/moderatedComments.php');
    }

    public function usernameSearch(array $username) : void 
    {
        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        $userFound = $userModel->getUserSearched($username);

        $userFoundCheck = new AdminHandler();
        $userFoundCheck->userFoundCheck($userFound);
    }

    public function changeUserRole(array $newUserRole) : void 
    {
        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        $roleChange = $userModel->modifyUserRole($newUserRole);

        $roleModificationCheck = new AdminHandler();
        $roleModificationCheck->roleModificationCheck($roleChange);
    }

}
