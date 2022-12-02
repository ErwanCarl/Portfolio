<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\model\UserModel;
use App\entity\User;
use App\services\SendMail;
use App\services\RedirectHandler;

class ConnectionHandler extends RedirectHandler
{
    public function connectionCheck(?User $userExtract) : void 
    {
        if ($userExtract !== null) {
            if($userExtract->getValidateAccount() != 1) {
                $_SESSION['error'] = "Votre compte n'est pas validé, veuillez vérifier vos emails pour procéder à la validation.";
                header('Location: /accountcreation');
            }else{
                $_SESSION['success'] = "Vous êtes connecté. Bienvenue !";
                $_SESSION['Connection'] = "Connected";
                $_SESSION['userInformations'] = [
                    'id'=>$userExtract->getId(),
                    'username'=>$userExtract->getUsername(),
                    'nickname'=>$userExtract->getNickname(),
                    'name'=>$userExtract->getName(),
                    'phonenumber'=>$userExtract->getPhonenumber(),
                    'mail'=>$userExtract->getMail(),
                    'validateAccount'=>$userExtract->getValidateAccount(),
                    'role'=>$userExtract->getRole()
                ];
                header('Location: /');
            }
        } else {
            $_SESSION['error'] = "Vos identifiants sont incorrects, veuillez réessayer.";
            header('Location: /accountcreation');
        }
    }

    public function passwordChangeCheck(?User $userCheck, UserModel $userModel) : void 
    {
        if($userCheck === null) {
            $_SESSION['error'] = "Le mail n'existe pas dans notre base de données.";
            require(TEMPLATE_DIR.'/accountCreation.php');
        }else{
            $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            $userCheck->setAccountKey($accountKey);
            $userModel->accountKeyGeneration($userCheck->getAccountKey(), $userCheck->getMail());

            $passwordMail = new SendMail();
            $passwordMail->passwordMail($userCheck);
        }
    }

    public function passwordLinkCheck(?User $user) : void 
    {
        if($user !== null) {
            require(TEMPLATE_DIR.'/lostPassword.php');
        }else{
            $_SESSION['error'] = "Le lien n'est pas ou plus valide, veuillez faire une autre demande de mot de passe oublié.";
            header('Location: /accountcreation');
        }
    }

    public function accountPasswordSecurityCheck(?User $userSecurity, array $userInfo) : void 
    {
        if($userSecurity !== null) {
            if($userInfo['password'] === $userInfo['passwordconfirmation']) {
                $passwordChange = new UserModel;
                $passwordChangeSuccess = $passwordChange->passwordChange($userInfo['password'], $userInfo['email']);
                    if($passwordChangeSuccess) {
                        $_SESSION['success'] = "Votre mot de passe a été modifié avec succès.";
                        require(TEMPLATE_DIR.'/accountCreation.php');
                    }else{
                        $_SESSION['error'] = "Le changement de mot de passe a échoué, veuillez contacter l'administrateur.";
                        require(TEMPLATE_DIR.'/accountCreation.php');
                    }
            }else{
                $user = new User();
                $user->setMail($userInfo['email']);
                $user->setAccountKey($userInfo['token']);
                $_SESSION['error'] = "Les mots de passe ne sont pas identiques, veuillez recommencer.";
                require(TEMPLATE_DIR.'/lostPassword.php');
            }
        }else{
            $_SESSION['error'] = "Alerte sécurité : le mail et la clé ne correspondent pas à la demande de changement de mot de passe.";
            require(TEMPLATE_DIR.'/accountCreation.php');
        }
    }

    public function isConnected() : void 
    {
        if(isset($_SESSION['Connection'])) {
            $_SESSION['error'] = "Vous êtes déjà connecté.";
            parent::redirect('forbidden');
        }
    }
}
