<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

class RedirectHandler
{
    public static function redirect(string $path) : void
    {
        header('Location: /'.$path);
        exit();
    }
}
