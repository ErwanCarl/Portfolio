<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

class ErrorController 
{
    public function notFound() : void
    {
        require(TEMPLATE_DIR.'/notfound.php');
    }

    public function forbidden() : void
    {
        require(TEMPLATE_DIR.'/forbidden.php');
    }
}
