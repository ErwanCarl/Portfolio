<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\services\SendMail;
use App\services\EmailFormatHandler;
use App\entity\User;

class MailController
{
    public function contactMail(array $form_input) : void 
    {
        $userMailFormat = new User();
        $userMailFormat->setMail($form_input['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $sendMail = new SendMail();
        $contactMail = $sendMail->sendContactMail($form_input);
    }     
}
