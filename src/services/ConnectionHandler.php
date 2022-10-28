<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');
require_once('src/services/SendMail.php');

class ConnectionHandler
{
    public function connectionCheck(?User $userExtract) : void 
    {
        if ($userExtract != null) {
            if($userExtract->getValidateAccount() != 1) {
                $_SESSION['error'] = "Votre compte n'est pas validé, veuillez vérifier vos emails pour procéder à la validation.";
                header('Location: index.php?action=accountcreation');
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
                header('Location: index.php');
            }
        } else {
            $_SESSION['error'] = "Vos identifiants sont incorrects, veuillez réessayer.";
            header('Location: index.php?action=accountcreation');
        }
    }

    public function passwordChangeCheck(?User $userCheck, UserModel $userModel) : void 
    {
        if($userCheck === null) {
            $_SESSION['error'] = "Le mail n'existe pas dans notre base de données.";
            require('templates/accountCreation.php');
        }else{
            $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            $userCheck->setAccountKey($accountKey);
            $accountKeyInsert = $userModel->accountKeyGeneration($userCheck->getAccountKey(), $userCheck->getMail());

            $passwordMail = new SendMail();
            $passwordMail->passwordMail($userCheck);
        }
    }

    public function passwordLinkCheck(?User $user) : void 
    {
        if($user != null) {
            require('templates/lostPassword.php');
        }else{
            $_SESSION['error'] = "Le lien n'est pas ou plus valide, veuillez faire une autre demande de mot de passe oublié.";
            require('templates/accountCreation.php');
        }
    }

    public function accountPasswordSecurityCheck(?User $userSecurity, array $userInfo) : void 
    {
        if($userSecurity != null) {
            if($userInfo['password'] === $userInfo['passwordconfirmation']) {
                $passwordChange = new UserModel;
                $passwordChangeSuccess = $passwordChange->passwordChange($userInfo['password'], $userInfo['email']);
                    if($passwordChangeSuccess) {
                        $_SESSION['success'] = "Votre mot de passe a été modifié avec succès.";
                        require('templates/accountCreation.php');
                    }else{
                        $_SESSION['error'] = "Le changement de mot de passe a échoué, veuillez contacter l'administrateur.";
                        require('templates/accountCreation.php');
                    }
            }else{
                $user = new User();
                $user->setMail($userInfo['email']);
                $user->setAccountKey($userInfo['token']);
                $_SESSION['error'] = "Les mots de passe ne sont pas identiques, veuillez recommencer.";
                require('templates/lostPassword.php');
            }
        }else{
            $_SESSION['error'] = "Alerte sécurité : le mail et la clé ne correspondent pas à la demande de changement de mot de passe.";
            require('templates/accountCreation.php');
        }
    }
}
