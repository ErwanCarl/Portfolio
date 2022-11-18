<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

class InputCheckHandler {

    public function userInputCheck(array $formInput) : void 
    {
        if(strlen($formInput['name']) > 50 || strlen($formInput['name']) === 0 || !preg_match($formInput['name'],"[a-zA-Z]+")) {
            $_SESSION['error'] = 'Le champ "Prénom" ne peut être vide, excéder 50 caractères et doit être composé seulement de lettres.';
            header('Location: /accountcreation');
            die;
        } elseif (strlen($formInput['username']) > 100 || strlen($formInput['username']) === 0) {
            $_SESSION['error'] = 'Le champ "Pseudo" ne peut être vide ou excéder 100 caractères.';
            header('Location: /accountcreation');
            die;
        } elseif (strlen($formInput['nickname']) > 50 || strlen($formInput['nickname']) === 0 || !preg_match($formInput['nickname'],"[a-zA-Z]+")) {
            $_SESSION['error'] = 'Le champ "Nom" ne peut être vide, excéder 50 caractères et doit être composé seulement de lettres.';
            header('Location: /accountcreation');
            die;
        } elseif (strlen($formInput['password']) > 255 || strlen($formInput['password']) === 0 || !preg_match($formInput['password'],"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$")) {
            $_SESSION['error'] = 'Le champ "Mot de passe" ne peut être vide, être inférieur à 8 caractères, excéder 255 et respecter le format.';
            header('Location: /accountcreation');
            die;
        } elseif (strlen($formInput['mail']) > 255 || strlen($formInput['mail']) === 0) {
            $_SESSION['error'] = 'Le champ "Mail" ne peut être vide ou excéder 255 caractères.';
            header('Location: /accountcreation');
            die;
        } elseif (isset($formInput['phonumber'])) {
            if(strlen($formInput['phonumber']) > 20 || !preg_match($formInput['phonuber'],"[0-9]{10,20}")) {
                $_SESSION['error'] = 'Le champ "Téléphone" doit seulement être composé de 10 à 20 chiffres.';
                header('Location: /accountcreation');
                die;
            }
        }
    }

    public function postInputCheck(array $formInput) : void 
    {
        if(strlen($formInput['title']) > 50 || strlen($formInput['title']) === 0) {
            $_SESSION['error'] = 'Le champ "Titre" ne peut être vide ou excéder 50 caractères.';
            header('Location: /postcreation');
            die;
        } elseif (strlen($formInput['chapo']) > 255 || strlen($formInput['chapo']) === 0) {
            $_SESSION['error'] = 'Le champ "Chapô" ne peut être vide ou excéder 255 caractères.';
            header('Location: /postcreation');
            die;
        } elseif (strlen($formInput['content']) === 0) {
            $_SESSION['error'] = 'Le champ "Contenu" ne peut être vide.';
            header('Location: /postcreation');
            die;
        }
    }

    public function passwordChangeInputCheck(array $formInput) : void 
    {
        if(strlen($formInput['password']) > 255 || strlen($formInput['password']) === 0 || !preg_match($formInput['password'],"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$")) {
            $_SESSION['error'] = 'Le champ "Mot de passe" ne peut être vide, être inférieur à 8 caractères, excéder 255 et respecter le format.';
            header('Location: /passwordlandingpage');
            die;
        }
    }
}
