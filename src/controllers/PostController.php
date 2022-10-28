<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');
require_once('src/services/PaginationHandler.php');
require_once('src/services/PostHandler.php');

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
        require('templates/post.php');
    }

    public function posts() : void 
    {
        $postModel = new PostModel();
        $posts = $postModel->getPosts();
        require('templates/blogposts.php');
    }

    public function postCreation() : void 
    {
        require('templates/postsEdition.php');
    }

    public function newPostSubmit(array $form_input, array $picture_file) : void 
    {
        $postDataCheck = new PostHandler();
        $postDataCheck->postCreateDataCheck($form_input, $picture_file);
    }

    public function postEdition($id) : void 
    {
        $postModel = new PostModel();
        $post = $postModel->postModification($id);
        $_SESSION['Modify'] = 'Set';
        require('templates/postsEdition.php');
    }

    public function modifySubmit(int $id, array $form_input, array $picture_file) : void 
    {
        $postDataCheck = new PostHandler();
        $postDataCheck->postModifyDataCheck($form_input, $picture_file, $id);
    }

    public function postDelete(int $id) : void 
    {
        $postModel = new PostModel();
        $postDelete = $postModel->postSuppression($id);

        $deleteCheck = new PostHandler();
        $deleteCheck->deleteCheck($postDelete); 
    }
}
