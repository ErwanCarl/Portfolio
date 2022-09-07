<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class ContactController 
{
    public function contact() : void
    {
        require('templates/contact.php');
    }
}
