<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');

class ConnectionController 
{
    public function accountConnection(array $formInput) : void
    {
        $userModel = new UserModel();
        $userExtract = $userModel->getUserInformations($formInput);
      
        if ($userExtract != null) {
            $_SESSION['success'] = "Vous êtes connecté. Bienvenue !";
            $_SESSION['Connection'] = "Connected";
            $_SESSION['userInformations'] = [
                'id'=>$userExtract->getId(),
                'username'=>$userExtract->getUsername(),
                'nickname'=>$userExtract->getNickname(),
                'name'=>$userExtract->getName(),
                'phonenumber'=>$userExtract->getPhonenumber(),
                'mail'=>$userExtract->getMail(),
                'logo'=>$userExtract->getLogo(),
                'validateAccount'=>$userExtract->getValidateAccount(),
                'role'=>$userExtract->getRole()
            ];
            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Vos identifiants sont incorrects, veuillez réessayer ou vérifier dans votre boîte mail que votre compte est bien validé.";
            header('Location: index.php?action=accountcreation');
        }
    }
}
