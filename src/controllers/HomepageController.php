<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\PostModel;
use App\services\TokenHandler;
use App\controllers\Basecontroller;

class HomepageController
{
    public function homepage() : void 
    {
        $postModel = new PostModel();
        $posts = $postModel -> getPostsHomepage();

        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();

        require(TEMPLATE_DIR.'/homepage.php');
    }
}
