<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');
require_once('src/entity/Comment.php');

class AddCommentController 
{  
    public function addComment(int $id, array $formInput): void 
    {
        $author = $_SESSION['userInformations']['username'];
        $content = null;
        
        if (!empty($author) && !empty($formInput['content'])) {
           $formInput['author'] = $author;
            $content = $formInput['content'];
        } else {
            $_SESSION['error'] = 'Les données du formulaire sont invalides, veuillez contacter l\'administrateur.';
            header('Location: index.php?action=post&id='.$id);
        }
    
        $addComment = new CommentModel();
        $comment = new Comment($formInput);
        $addCommentSuccessfull = $addComment->createComment($id, $comment);

        if($addCommentSuccessfull) {
            $_SESSION['success'] = 'Votre commentaire a bien été ajouté et est en cours de modération.';
            header('Location: index.php?action=post&id='.$id);
        }else{
            $_SESSION['error'] = 'Impossible d\'ajouter le commentaire.';
            header('Location: index.php?action=post&id='.$id);
        }
    }
}