<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class LegalNoticeController 
{
    public function legalNotice() : void 
    {
        require('templates/legalnotice.php');
    }
}
