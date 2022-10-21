<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/services/SendMail.php');

class MailController
{
    public function contactMail(array $form_input) : void 
    {
       $sendMail = new SendMail();
       $contactMail = $sendMail->sendContactMail($form_input);
    }     
}
