<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

class ContactController 
{
    public function contact() : void
    {
        require(TEMPLATE_DIR.'/contact.php');
    }
}
