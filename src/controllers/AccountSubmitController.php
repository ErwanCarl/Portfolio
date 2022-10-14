<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');
require_once('src/controllers/MailController.php');
require_once('src/services/sendMail.php');


class AccountSubmitController
{
    public function accountSubmit($formInput) : void 
    {

        $userModel = new UserModel();
        $user = new User($formInput);
        $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $user->setAccountKey($accountKey);
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
                $sendMail = new sendMail();
                $accountValidationMail = $sendMail->sendAccountValidationMail($user);

                if($accountValidationMail) {
                    $_SESSION['success'] = "Votre compte a bien été créé, vérifiez vos mails pour le valider.";
                    header('Location: index.php?action=accountcreation');
                }else{
                    $_SESSION['error'] = "Le mail de validation de compte n'a pas été envoyé, veuillez contacter l'administrateur";
                    header('Location: index.php?action=accountcreation');
                }
            }else{
                $_SESSION['error'] = "Impossible de créer le compte, veuillez contacter l'administrateur";
                header('Location: index.php?action=accountcreation');
            }
        }

    }

    public function inscriptionValidation(string $accountKey) : void 
    {
        $userModel = new UserModel();
        $validateAccount = $userModel->validateAccount($accountKey);
        if($validateAccount) {
            $_SESSION['success'] = "Votre compte a été validé, vous pouvez désormais vous connecter.";
            header('Location: index.php?action=accountcreation');
        }else{
            $_SESSION['error'] = "Le lien a expiré ou a déjà été utilisé, veuillez tenter de vous connecter ou contactez l'administrateur.";
            header('Location: index.php?action=accountcreation');
        }
    }

}