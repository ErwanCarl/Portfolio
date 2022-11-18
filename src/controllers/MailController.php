<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\services\SendMail;
use App\services\EmailFormatHandler;
use App\services\TokenHandler;
use App\entity\User;

class MailController
{
    public function contactMail() : void 
    {
        $csrfTokenCheck = new TokenHandler();
        $csrfTokenCheck->csrfTokenCheck($_POST['csrf_token']);

        $userMailFormat = new User();
        $userMailFormat->setMail($_POST['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $sendMail = new SendMail();
        $sendMail->sendContactMail($_POST);
    }     
}
