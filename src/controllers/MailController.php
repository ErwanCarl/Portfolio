<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/services/SendMail.php');
require_once('src/services/EmailFormatHandler.php');
require_once('src/entity/User.php');

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
