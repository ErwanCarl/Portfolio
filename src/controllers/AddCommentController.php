<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');
require_once('src/entity/Comment.php');

class AddCommentController 
{  
    public function addComment(string $id, array $formInput): void 
    {
        $author = null;
        $content = null;
        
        if (!empty($formInput['author']) && !empty($formInput['content'])) {
            $author = $formInput['author'];
            $content = $formInput['content'];
        } else {
            die('Les données du formulaire sont invalides.');
        }
    
        $addComment = new CommentModel();
        $comment = new Comment($formInput);
        $addCommentSuccessfull = $addComment->createComment($id, $comment);

        if($addCommentSuccessfull) {
            header('Location: index.php?action=post&id='.$id);
        }else{
            die("Impossible d'ajouter le commentaire.");
        }
    }
}