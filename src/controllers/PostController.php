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

    public function newPostSubmit(array $form_input, array $picture_file) : void 
    {
        if(!isset($picture_file['picture']) || $picture_file['picture']['error'] != 0) {
            $_SESSION['error'] = 'Le téléchargement de l\'image a échoué.';
            header('Location:index.php?action=postcreation');
        } else {    
            if($picture_file['picture']['size'] <= 1000000) {
                $fileInfo = pathinfo($picture_file['picture']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions)) {
                    move_uploaded_file($picture_file['picture']['tmp_name'], 'images/posts_pictures/' . basename($picture_file['picture']['name']));
                    $picture = 'images/posts_pictures/' . basename($picture_file['picture']['name']);
                    $form_input['author'] = $_SESSION['userInformations']['username'];

                    $postModel = new PostModel();
                    $post = new Post($form_input);
                    $post->setUserId($_SESSION['userInformations']['id']);
                    $post->setPicture($picture);
                    $postCreate = $postModel->postCreate($post);

                    if($postCreate) {
                        $_SESSION['success'] = 'L\'article a correctement été crée.';
                        header('Location:index.php?action=blogposts');
                    } else {
                        $_SESSION['error'] = 'La création de l\'article a échouée.';
                        header('Location:index.php?action=postcreation');
                    }
                } else {
                    $_SESSION['error'] = 'Attention, les extensions autorisées pour les images sont PNG, JPG, JPEG et GIF.';
                    header('Location:index.php?action=postcreation');
                }
            } else {
                $_SESSION['error'] = 'L\'image ne doit pas dépasser 1 Mo.';
                header('Location:index.php?action=postcreation');
            } 
        }
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
        if(!isset($picture_file['picture']) || $picture_file['picture']['error'] != 0) {
            $_SESSION['error'] = 'Le téléchargement de l\'image a échoué.';
            header('Location:index.php?action=postmodify&id='.$id);
        } else {    
            if($picture_file['picture']['size'] <= 1000000) {
                $fileInfo = pathinfo($picture_file['picture']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions)) {
                    move_uploaded_file($picture_file['picture']['tmp_name'], 'images/posts_pictures/' . basename($picture_file['picture']['name']));
                    $picture = 'images/posts_pictures/' . basename($picture_file['picture']['name']);

                    $postModel = new PostModel();
                    $form_input['author'] = $_SESSION['userInformations']['username'];
                    $post = new Post($form_input);
                    $post->setId($id);
                    $post->setPicture($picture);
                    $postModify = $postModel->modifyRegister($post);

                    if($postModify) {
                        unset($_SESSION['Modify']);
                        $_SESSION['success'] = 'L\'article a été correctement modifié.';
                        header('Location:index.php?action=post&id='.$id);
                    } else {
                        $_SESSION['error'] = 'La modification de l\'article a échouée.';
                        header('Location:index.php?action=postmodify&id='.$id);  
                    }                  
                } else {
                    $_SESSION['error'] = 'Attention, les extensions autorisées pour les images sont PNG, JPG, JPEG et GIF.';
                    header('Location:index.php?action=postmodify&id='.$id);                    
                }
            } else {
                $_SESSION['error'] = 'L\'image ne doit pas dépasser 1 Mo.';
                header('Location:index.php?action=postmodify&id='.$id);                    
            } 
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
