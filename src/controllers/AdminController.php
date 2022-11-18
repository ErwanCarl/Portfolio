<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\CommentModel;
use App\model\UserModel;
use App\services\AdminHandler;
use App\services\TokenHandler;
use App\services\PaginationHandler;

class AdminController 
{
    public function administration() : void
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();

        $admin = new AdminHandler();
        $admin->adminAccessCheck();
    }

    public function commentValidate($id) : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);
        
        $commentModel = new CommentModel();
        $validateComment = $commentModel->commentValidation((int) $id);

        $adminValidateCommentCheck = new AdminHandler();
        $adminValidateCommentCheck->adminValidateCommentCheck($validateComment);
    }

    public function commentRestaurate(int $id) : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);
        
        $commentModel = new CommentModel();
        $validateComment = $commentModel->commentValidation((int) $id);

        $adminRestaurateCommentCheck = new AdminHandler();
        $adminRestaurateCommentCheck->adminRestaurateCommentCheck($validateComment);
    }

    public function commentDelete($id) : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);

        $commentModel = new CommentModel();
        $deleteComment = $commentModel->commentModeration((int) $id);

        $adminDeleteCommentCheck = new AdminHandler();
        $adminDeleteCommentCheck->adminDeleteCommentCheck($deleteComment);
    }

    public function moderatedComment(?int $page) : void 
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();
        
        $elementsNumber = 5;
        $commentModel = new CommentModel();
        $moderatedCommentsNumber = $commentModel->moderatedCommentsCount();
        $pageNumber = ceil($moderatedCommentsNumber[0]['moderatedCommentsNumber'] / $elementsNumber);

        $pagination = new PaginationHandler();
        $currentPage = $pagination->pagination($page, $pageNumber);

        $moderatedComments = $commentModel->moderatedListing($currentPage, $elementsNumber);
        require(TEMPLATE_DIR.'/moderatedComments.php');
    }

    public function usernameSearch() : void 
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();

        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        $userFound = $userModel->getUserSearched($_POST);

        $userFoundCheck = new AdminHandler();
        $userFoundCheck->userFoundCheck($userFound);
    }

    public function changeUserRole() : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);

        $_POST['username'] = $_SESSION['userChange']['username'];
        unset($_SESSION['userChange']);
        $userModel = new UserModel();
        $roleChange = $userModel->modifyUserRole($_POST);

        $roleModificationCheck = new AdminHandler();
        $roleModificationCheck->roleModificationCheck($roleChange);
    }

}
