<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\CommentModel;
use App\model\PostModel;
use App\services\PaginationHandler;
use App\services\PostHandler;
use App\services\TokenHandler;
use App\services\InputCheckHandler;

class PostController 
{
    public function post(int $id, int $page) : void
    {
        $postModel = new PostModel();
        $post = $postModel->getPost($id);

        $commentModel = new CommentModel();
        $elementsNumber = 5;
        $validateCommentsNumber = $commentModel->validateCommentsCount($id);
        $pageNumber = ceil($validateCommentsNumber[0]['validateCommentsNumber'] / $elementsNumber);

        $pagination = new PaginationHandler();
        $currentPage = $pagination->pagination($page, $pageNumber);
        
        $comments = $commentModel->getComments($id, $currentPage, $elementsNumber);

        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();
        
        require(TEMPLATE_DIR.'/post.php');
    }

    public function posts() : void 
    {
        $postModel = new PostModel();
        $posts = $postModel->getPosts();
        require(TEMPLATE_DIR.'/blogposts.php');
    }

    public function postCreation() : void 
    {
        require(TEMPLATE_DIR.'/postsEdition.php');
    }

    public function newPostSubmit() : void 
    {
        $inputCheck = new InputCheckHandler();
        $inputCheck->postInputCheck($_POST);

        $postDataCheck = new PostHandler();
        $postDataCheck->postCreateDataCheck($_POST, $_FILES);
    }

    public function postEdition(int $id) : void 
    {
        $postModel = new PostModel();
        $post = $postModel->postModification($id);
        $_SESSION['Modify'] = 'Set';
        require(TEMPLATE_DIR.'/postsEdition.php');
    }

    public function modifySubmit(int $id) : void 
    {
        $inputCheck = new InputCheckHandler();
        $inputCheck->postInputCheck($_POST);
        
        $postDataCheck = new PostHandler();
        $postDataCheck->postModifyDataCheck($_POST, $_FILES, $id);
    }

    public function postDelete(int $id) : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);

        $postModel = new PostModel();
        $postDelete = $postModel->postSuppression($id);

        $deleteCheck = new PostHandler();
        $deleteCheck->deleteCheck($postDelete); 
    }
}
