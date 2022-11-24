<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\entity\User;
use \Exception;

class EmailFormatHandler {

    public function emailFormatCheck(User $user) : void 
    {
        try {
            $email = $user->getMail();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "L'email entré n'est pas au bon format.";
                throw new Exception('');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $message;
            header('Location: /accountcreation');
            exit();
        }

        // $email = $user->getMail();
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $_SESSION['error'] = "L'email entré n'est pas au bon format.";
        //     header('Location: /accountcreation');
        //     exit();
        // }
    }
}
