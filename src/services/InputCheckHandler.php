<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

class InputCheckHandler {

    public function userInputCheck(array $formInput) : void 
    {
        if(!preg_match("/^([a-zA-Z' ]{1,50})$/", $formInput['name'])) {
            $_SESSION['error'] = 'Le champ "Nom" ne peut être vide, excéder 50 caractères et doit être composé seulement de lettres.';
            header('Location: /accountcreation');
            exit();
        } elseif (strlen($formInput['username']) > 100 || strlen($formInput['username']) === 0) {
            $_SESSION['error'] = 'Le champ "Pseudo" ne peut être vide ou excéder 100 caractères.';
            header('Location: /accountcreation');
            exit();
        } elseif (!preg_match("/^([a-zA-Z' ]{1,50})$/", $formInput['nickname'])) {
            $_SESSION['error'] = 'Le champ "Prénom" ne peut être vide, excéder 50 caractères et doit être composé seulement de lettres.';
            header('Location: /accountcreation');
            exit();
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,255}$/", $formInput['password'])) {
            $_SESSION['error'] = 'Le champ "Mot de passe" ne peut être vide, être inférieur à 8 caractères, excéder 255 et doit respecter le format.';
            header('Location: /accountcreation');
            exit();
        } elseif (strlen($formInput['mail']) > 255 || strlen($formInput['mail']) === 0) {
            $_SESSION['error'] = 'Le champ "Mail" ne peut être vide ou excéder 255 caractères.';
            header('Location: /accountcreation');
            exit();
        } elseif (isset($formInput['phonenumber'])) {
            if(!preg_match("/[0-9]{10,20}/", $formInput['phonenumber'])) {
                $_SESSION['error'] = 'Le champ "Téléphone" doit seulement être composé de 10 à 20 chiffres.';
                header('Location: /accountcreation');
                exit();
            }
        }
    }

    public function postInputCheck(array $formInput) : void 
    {
        if(strlen($formInput['title']) > 50 || strlen($formInput['title']) === 0) {
            $_SESSION['error'] = 'Le champ "Titre" ne peut être vide ou excéder 50 caractères.';
            header('Location: /postcreation');
            exit();
        } elseif (strlen($formInput['chapo']) > 255 || strlen($formInput['chapo']) === 0) {
            $_SESSION['error'] = 'Le champ "Chapô" ne peut être vide ou excéder 255 caractères.';
            header('Location: /postcreation');
            exit();
        } elseif (strlen($formInput['content']) === 0) {
            $_SESSION['error'] = 'Le champ "Contenu" ne peut être vide.';
            header('Location: /postcreation');
            exit();
        }
    }

    public function passwordChangeInputCheck(array $formInput) : void 
    {
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,255}$/", $formInput['password'])) {
            $_SESSION['error'] = 'Le champ "Mot de passe" ne peut être vide, être inférieur à 8 caractères, excéder 255 et doit respecter le format.';
            header('Location: /passwordlandingpage');
            exit();
        }
    }
}
