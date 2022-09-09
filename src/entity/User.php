<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class User {

    private $id;
    private $name;
    private $nickname;
    private $username;
    private $logo;
    private $password;
    private $mail;
    private $phoneNumber;
    private $validateAccount;

    public function __construct($data = []) 
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data) : void
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


/* ---------------------------- Getters -----------------------------*/

    public function getId() : int
    { 
        return $this->id; 
    }

    public function getName() : string
    { 
        return $this->name; 
    }

    public function getNickname() : string
    { 
        return $this->nickname; 
    }

    public function getUsername() : string
    { 
        return $this->username; 
    }

    public function getLogo() : string
    { 
        return $this->logo; 
    }

    public function getPassword() : string
    { 
        return $this->password; 
    }

    public function getMail() : string
    { 
        return $this->mail; 
    }

    public function getPhoneNumber() : string
    { 
        return $this->phoneNumber; 
    }

    public function getValidateAccount() : int
    { 
        return $this->validateAccount; 
    }

/* ---------------------------- Setters -----------------------------*/



    public function setName(string $name) : void
    {
        if (strlen($name) < 50) {
            $this->name = $name;
        }
    }

    public function setNickname(string $nickname) : void
    {
        if(strlen($nickname) < 50) {
            $this->nickname = $nickname;
        }
    }

    public function setUsername(string $username) : void
    {
        if(strlen($username) < 100) {
            $this->username = $username;
        }
    }

    public function setLogo(string $logo) : void
    {
        if(strlen($logo) < 255) {
            $this->logo = $logo;
        }
    }

    public function setPassword(string $password) : void
    {
        if(strlen($password) < 255) {
            $this->password = $password;
        }
    }

    public function setMail(string $mail) : void
    {
        if (strlen($mail) < 255) {
            $this->mail = $mail;
        }
    }

    public function setPhoneNumber(string $phoneNumber) : void
    {
        if (strlen($phoneNumber) < 20) {
            $this->phoneNumber = $phoneNumber;
        }
    }

    public function setValidateAccount(int $validateAccount) : void
    {
        if (strlen($validateAccount) <= 1) {
            $this->validateAccount = $validateAccount;
        }
    }

}