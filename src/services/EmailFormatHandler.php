<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');
require_once('src/services/SendMail.php');

class EmailFormatHandler {

    public function emailFormatCheck(User $user) : void 
    {
        $email = $user->getMail();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "L'email entré n'est pas au bon format.";
            header('Location: index.php?action=accountcreation');
            die;
        }
    }
}
