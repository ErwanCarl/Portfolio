<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\PostModel;

class HomepageController 
{
    public function homepage() : void 
    {
        $postModel = new PostModel();
        $posts = $postModel -> getPostsHomepage();
        require('templates/homepage.php');
    }
}
