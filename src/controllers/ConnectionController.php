<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');

class ConnectionController 
{
    public function accountConnection($formInput) : void
    {
        $userModel = new UserModel();
        /* changer nom methode */
        $userExtract = $userModel->accountCheck($formInput);
      
        if ($userExtract) {
            $_SESSION['FlashValidConnection'] = "Vous êtes connecté. Bienvenue !";
            $_SESSION['Connection'] = "Connected";
            header('Location: index.php');
        } else {
            $_SESSION['FlashFailedConnection'] = "Vos identifiants sont incorrects, veuillez réessayer.";
            header('Location: index.php?action=accountcreation');
        }
    }
}
