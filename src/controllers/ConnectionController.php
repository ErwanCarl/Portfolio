<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\UserModel;
use App\entity\User;
use App\services\ConnectionHandler;
use App\services\EmailFormatHandler;
use App\services\TokenHandler;
use App\services\InputCheckHandler;

class ConnectionController 
{
    public function accountConnection() : void
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);

        $userMailFormat = new User();
        $userMailFormat->setMail($_POST['mail']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userExtract = $userModel->getUserInformations($_POST);

        $connectionCheck = new ConnectionHandler();
        $connectionCheck->connectionCheck($userExtract);
    }

    public function passwordLandingPage() : void 
    {
        require(TEMPLATE_DIR.'/lostPassword.php');
    }

    public function lostPassword() : void 
    {
        $userMailFormat = new User();
        $userMailFormat->setMail($_POST['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userCheck = $userModel->getUserByMailCheck($userMailFormat->getMail());
        $passwordChangeCheck = new ConnectionHandler();
        $passwordChangeCheck -> passwordChangeCheck($userCheck, $userModel);
    }

    public function passwordModifyCheck(string $token) : void 
    {
        $userModel = new UserModel();
        $user = $userModel->accountCheck($token);
        $passwordLinkCheck = new ConnectionHandler();
        $passwordLinkCheck -> passwordLinkCheck($user);
    }

    public function passwordModify() : void 
    {
        $inputCheck = new InputCheckHandler();
        $inputCheck->passwordChangeInputCheck($_POST);
        
        $userMailFormat = new User();
        $userMailFormat->setMail($_POST['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userSecurity = $userModel->userPasswordChangeSecurity($_POST);
        $accountPasswordSecurityCheck = new ConnectionHandler();
        $accountPasswordSecurityCheck->accountPasswordSecurityCheck($userSecurity, $_POST);
    }

    public function closeSession() : void 
    {
        unset($_SESSION);
        session_destroy();
        header('Location: /accountcreationending');
    }
}
