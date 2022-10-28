<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

class PassionController 
{
    public function passionList() : void 
    {
        require('templates/passions.php');
    }
}
