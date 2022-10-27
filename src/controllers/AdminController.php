<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\CommentModel;
use App\model\UserModel;
use App\services\AdminHandler;
use App\services\PaginationHandler;

class AdminController 
{
    public function administration() : void
    {
        $admin = new AdminHandler();
        $admin->adminAccessCheck();
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
