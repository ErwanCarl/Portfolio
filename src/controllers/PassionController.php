<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class PassionController 
{
    public function passionList() : void 
    {
        require('templates/passions.php');
    }

}