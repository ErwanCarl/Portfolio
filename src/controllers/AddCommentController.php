<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\CommentModel;
use App\services\AddCommentHandler;

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
