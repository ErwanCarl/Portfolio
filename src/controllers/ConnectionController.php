<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');
require_once('src/services/ConnectionHandler.php');
require_once('src/services/SendMail.php');


class ConnectionController 
{
    public function accountConnection(array $formInput) : void
    {
        $userModel = new UserModel();
        $userExtract = $userModel->getUserInformations($formInput);

        $connectionCheck = new ConnectionHandler();
        $connectionCheck->connectionCheck($userExtract);
    }

    public function passwordLandingPage() : void 
    {
        require('templates/lostPassword.php');
    }

    public function lostPassword(array $formInput) : void 
    {
        $userModel = new UserModel();
        $userCheck = $userModel->getUserByMailCheck($formInput['email']);
        $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $userCheck->setAccountKey($accountKey);
        $accountKeyInsert = $userModel->accountKeyGeneration($userCheck->getAccountKey(), $userCheck->getMail());

        $passwordMail = new SendMail();
        $passwordMail->passwordMail($userCheck);
    }

    public function passwordModifyCheck(array $mailInfo) : void 
    {
        $accountKey = $mailInfo['token'];
        $userModel = new UserModel();
        $user = $userModel->accountCheck($accountKey);
        if($user != null) {
            require('templates/lostPassword.php');
        }else{
            $_SESSION['error'] = "Le lien n'est pas ou plus valide, veuillez faire une autre demande de mot de passe oublié.";
            require('templates/accountCreation.php');
        }
    }

    public function passwordModify(string $userInfo) : void 
    {
        $userModel = new UserModel();
        $userSecurity = $userModel->userSecurity();

        if($userSecurity) {
            if($userInfo['password'] === $userInfo['passwordconfirmation']) {
                $passwordChange = new UserModel;
                $passwordChangeSuccess = $passwordChange->passwordChange($userInfo['email'], $userInfo['password']);
                    if($passwordChangeSuccess) {
                        $_SESSION['success'] = "Votre mot de passe a été modifié avec succès.";
                        require('templates/accountCreation.php');
                    }else{
                        $_SESSION['error'] = "Le changement de mot de passe a échoué, veuillez contacter l'administrateur.";
                        require('templates/accountCreation.php');
                    }
            }else{
                $user = new User();
                $user->setMail($userMail);
                $_SESSION['error'] = "Les mots de passe ne sont pas identiques, veuillez recommencer.";
                require('templates/lostPassword.php');
            }
        }else{
            $_SESSION['error'] = "Le mail ne correspond pas à la demande de changement de mot de passe.";
            require('templates/accountCreation.php');
        }

       
    }
}
