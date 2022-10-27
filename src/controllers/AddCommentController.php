<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/services/AddCommentHandler.php');

class AddCommentController 
{  
    public function addComment(int $id, array $formInput): void 
    {
        $author = $_SESSION['userInformations']['username'];
        $content = null;
        
        $addCommentHandler = new AddCommentHandler();
        $comment = $addCommentHandler->formDataCheck($content, $author, $formInput, $id);
        
        $addComment = new CommentModel();
        $addCommentSuccessfull = $addComment->createComment($id, $comment);

        $addCommentHandler->addCommentCheck($id, $addCommentSuccessfull);
    }
}
