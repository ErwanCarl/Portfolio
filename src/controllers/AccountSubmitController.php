<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\UserModel;
use App\entity\User;
use App\services\AccountValidationHandler;
use App\services\EmailFormatHandler;
use App\services\InputCheckHandler;

class AccountSubmitController
{
    public function accountSubmit() : void 
    {
        $inputCheck = new InputCheckHandler();
        $inputCheck->userInputCheck($_POST);

        $userModel = new UserModel();
        $user = new User($_POST);

        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($user);

        $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $user->setAccountKey($accountKey);
        $userModel->userPseudoCheck($user);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->accountCreationHandler($userModel, $user);
    }

    public function inscriptionValidation(string $token) : void 
    {
        $userModel = new UserModel();
        $validateAccount = $userModel->validateAccount($token);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->validationCheck($validateAccount);
    }
}
