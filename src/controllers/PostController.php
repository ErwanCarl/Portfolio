<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/CommentModel.php');
require_once('src/model/PostModel.php');

class PostController 
{

    public function post(string $id) : void
    {
        $postModel = new PostModel();
        $post = $postModel->getPost($id);
        
        $commentModel = new CommentModel();
        $comments = $commentModel->getComments($id);

        require('templates/post.php');
    }

}
