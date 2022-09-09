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
            $_SESSION['error'] = "Ce pseudo est déjà utilisé, veuillez en choisir un autre.";
            header('Location: index.php?action=accountcreation');
        } elseif ($userModel->userMailCheck($user) > 0) {
            $_SESSION['error'] = "Cet email est déjà utilisé, veuillez en utiliser un autre.";
            header('Location: index.php?action=accountcreation');
        } else {
            $result = $userModel->userCreation($user);

            if($result) {
                $_SESSION['success'] = "Votre compte a bien été crée, vous pouvez désormais vous connecter.";
                header('Location: index.php');
            }else{
                $_SESSION['error'] = "Impossible de créer le compte, veuillez contacter l'administrateur";
                header('Location: index.php?action=accountcreation');
            }
        }

    }
}