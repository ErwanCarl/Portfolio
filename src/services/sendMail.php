<?php

require_once('src/config/ConfigMail.php');
require 'vendor/autoload.php';
use \Mailjet\Resources;
use \PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class sendMail extends ConfigMail {

    private const HOST = 'https://127.0.0.1:8000/';

    public function sendContactMail(array $form_input) : void 
    {
        $mail = new PHPMailer();
        
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = parent::getHost();                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = parent::getUsername();                     //SMTP username
        $mail->Password   = parent::getPassword();                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($form_input['email']);
        $mail->addAddress('erwan.carlini@orange.fr');     
        $mail->addReplyTo('erwan.carlini@orange.fr', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Prise de contact - '.$form_input['name'];
        $mail->Body    = $form_input['message'];
        $mail->AltBody = $form_input['message'];

        if($mail->send()) {
            $_SESSION['success'] = "La prise de contact a bien été envoyé à l'administrateur.";
            header('Location: index.php');
        }else{
            $_SESSION['error'] = "L'envoi du message a échoué. Erreur : {$mail->ErrorInfo}.";
            header('Location: index.php');
        }
    }

    public function sendAccountValidationMail(User $user) : bool 
    {
        $mail = new PHPMailer();
      
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = parent::getHost();                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = parent::getUsername();                     //SMTP username
        $mail->Password   = parent::getPassword();                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('erwan.carlini@orange.fr');
        $mail->addAddress($user->getMail());     
        $mail->addReplyTo('erwan.carlini@orange.fr', 'Information');
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Validation de votre compte - '.$user->getUsername();
        $mail->Body    = 
            '<p>Bienvenue sur le site portfolio de Erwan Carlini,</p>
    
            <p>Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
            ou copier/coller dans votre navigateur Internet. </p>
            
            <p>'.self::HOST.'/index.php?action=inscriptionvalidation&token='.$user->getAccountKey().'</p>
            
            <p>-------------------------------</p>
            <p>Ceci est un mail automatique, merci de ne pas y répondre.</p>'; 

        $mail->AltBody = 
            'Bienvenue sur le site portfolio de Erwan Carlini,
        
            Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
            ou copier/coller dans votre navigateur Internet. 
            
            '.self::HOST.'/index.php?action=inscriptionvalidation&token='.$user->getAccountKey().'
            
            -------------------------------
            Ceci est un mail automatique, merci de ne pas y répondre.'; 

        return $mail->send();
    }
}