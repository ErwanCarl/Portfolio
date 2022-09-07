<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');

class AccountSubmitController
{
    public function accountSubmit($formInput) : void 
    {

        $userModel = new UserModel();
        $user = new User($formInput);
        $usert = $userModel->userPseudoCheck($user);

        if ($userModel->userPseudoCheck($user) > 0) {
            $_SESSION['FlashExistingPseudo'] = "Ce pseudo est déjà utilisé, veuillez en choisir un autre.";
            header('Location: index.php?action=accountcreation');
        } elseif ($userModel->userMailCheck($user) > 0) {
            $_SESSION['FlashExistingMail'] = "Cet email est déjà utilisé, veuillez en utiliser un autre.";
            header('Location: index.php?action=accountcreation');
        } else {
            $result = $userModel->userCreation($user);

            if($result) {
                header('Location: index.php');
            }else{
                die("Impossible de créer le compte.");
            }
        }

    }
}