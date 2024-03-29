<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\model\PostModel;
use App\entity\Post;

class PostHandler {

    public function deleteCheck(bool $postDelete) : void 
    {
        if($postDelete) {
            $_SESSION['success2'] = 'L\'article a bien été supprimé.';
            header('Location: /admin#gestionArticle');
        } else {
            $_SESSION['error2'] = 'La suppression de l\'article a échouée.';
            header('Location: /admin#gestionArticle');
        }
    }

    public function postCreateDataCheck(array $form_input, array $picture_file) : void 
    {
        if(!isset($picture_file['picture']) || $picture_file['picture']['error'] != 0) {
            $_SESSION['error'] = 'Une image est requise, son téléchargement a échoué.';
            header('Location: /postcreation');
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
                        header('Location: /blogposts');
                    } else {
                        $_SESSION['error'] = 'La création de l\'article a échouée.';
                        header('Location: /postcreation');
                    }
                } else {
                    $_SESSION['error'] = 'Attention, les extensions autorisées pour les images sont PNG, JPG, JPEG et GIF.';
                    header('Location: /postcreation');
                }
            } else {
                $_SESSION['error'] = 'L\'image ne doit pas dépasser 1 Mo.';
                header('Location: /postcreation');
            } 
        }
    }

    public function postModifyDataCheck(array $form_input, array $picture_file, int $id) : void 
    {
        if($picture_file['picture']['error'] != 0 && $picture_file['picture']['error'] != 4) {
            $_SESSION['error'] = 'Le téléchargement de l\'image a échoué.';
            header('Location: /postmodify/'.$id);
        } else {    
            if($picture_file['picture']['size'] <= 1000000 && $picture_file['picture']['error'] != 4) {
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
                        header('Location: /post/'.$id.'/1');
                    } else {
                        $_SESSION['error'] = 'La modification de l\'article a échouée.';
                        header('Location: /postmodify/'.$id);  
                    }                  
                } else {
                    $_SESSION['error'] = 'Attention, les extensions autorisées pour les images sont PNG, JPG, JPEG et GIF.';
                    header('Location: /postmodify/'.$id);                    
                }
            } elseif($picture_file['picture']['error'] = 4) {
                $picture = null;
                $postModel = new PostModel();
                $form_input['author'] = $_SESSION['userInformations']['username'];
                $post = new Post($form_input);
                $post->setId($id);
                $post->setPicture($picture);
                $postModify = $postModel->modifyRegister($post);

                if($postModify) {
                    unset($_SESSION['Modify']);
                    $_SESSION['success'] = 'L\'article a été correctement modifié.';
                    header('Location: /post/'.$id.'/1');
                } else {
                    $_SESSION['error'] = 'La modification de l\'article a échouée.';
                    header('Location: /postmodify/'.$id);  
                }                                    
            } else {
                $_SESSION['error'] = 'L\'image ne doit pas dépasser 1 Mo.';
                header('Location: /postmodify/'.$id);                    
            } 
        }
    }
}
