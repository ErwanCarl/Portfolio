<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/PostModel.php');

class HomepageController 
{
    public function homepage() : void 
    {
        $postModel = new PostModel();
        $posts = $postModel -> getPosts();
        require('templates/homepage.php');
    }
}