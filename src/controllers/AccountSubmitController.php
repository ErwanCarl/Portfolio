<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');
require_once('src/services/AccountValidationHandler.php');

class AccountSubmitController
{
    public function accountSubmit($formInput) : void 
    {
        $userModel = new UserModel();
        $user = new User($formInput);
        $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $user->setAccountKey($accountKey);
        $usert = $userModel->userPseudoCheck($user);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->accountCreationHandler($userModel, $user);
    }

    public function inscriptionValidation(string $accountKey) : void 
    {
        $userModel = new UserModel();
        $validateAccount = $userModel->validateAccount($accountKey);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->validationCheck($validateAccount);
    }

}