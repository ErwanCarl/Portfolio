<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require 'vendor/autoload.php';

class Autoloader 
{
    public static function register() 
    {
        define('DIR_ROOT', __DIR__.DIRECTORY_SEPARATOR);
 
        $autoloader = function($full_class_name) 
        {
            $name = str_replace('\\', DIRECTORY_SEPARATOR, $full_class_name);
            $path = DIR_ROOT.$name.'.php';
 
            if (is_file($path)) {
                include $path;
                return true;
            } else {
                return false;
            }
        };
        spl_autoload_register($autoloader);
    }
}
