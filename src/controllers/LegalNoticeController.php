<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

class LegalNoticeController 
{
    public function legalNotice() : void 
    {
        require(TEMPLATE_DIR.'/legalnotice.php');
    }
}
