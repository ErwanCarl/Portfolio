<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/services/sendMail.php');

class MailController
{
    public function contactMail(array $form_input) : void 
    {
       $sendMail = new sendMail();
       $contactMail = $sendMail->sendContactMail($form_input);
    }     
}
