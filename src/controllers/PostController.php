<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');

class PostController 
{

    public function post(int $id) : void
    {
        $postModel = new PostModel();
        $post = $postModel->getPost($id);
        
        $commentModel = new CommentModel();
        $comments = $commentModel->getComments($id);

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

    public function newPostSubmit(array $form_input) : void 
    {
        $postModel = new PostModel();
        $post = new Post($form_input);
        $post->setUserId($_SESSION['userInformations']['id']);
        $postCreate = $postModel->postCreate($post);

        if($postCreate) {
            $_SESSION['success'] = 'L\'article a correctement été crée.';
            header('Location:index.php?action=blogposts');
        } else {
            $_SESSION['error'] = 'La création de l\'article a échouée.';
            header('Location:index.php?action=postcreation');
        }
    }

    public function postEdition($id) : void 
    {
        $postModel = new PostModel();
        $post = $postModel->postModification($id);
        $_SESSION['Modify'] = 'Set';
        require('templates/postsEdition.php');
    }

    public function modifySubmit(int $id, array $form_input) : void 
    {
        $postModel = new PostModel();
        $post = new Post($form_input);
        $post->setId($id);
        $postModify = $postModel->modifyRegister($post);

        if($postModify) {
            unset($_SESSION['Modify']);
            $_SESSION['success'] = 'L\'article a été correctement modifié.';
            header('Location:index.php?action=post&id='.$id);
        } else {
            $_SESSION['error'] = 'La modification de l\'article a échouée.';
            require('templates/postsEdition.php');
        }
    }

    public function postDelete(int $id) : void 
    {
        $postModel = new PostModel();
        $postDelete = $postModel->postSuppression($id);

        if($postDelete) {
            $_SESSION['success2'] = 'L\'article a bien été supprimé.';
            header('Location:index.php?action=admin#gestionArticle');
        } else {
            $_SESSION['error2'] = 'La suppression de l\'article a échouée.';
            header('Location:index.php?action=admin#gestionArticle');
        }

        
    }

}
