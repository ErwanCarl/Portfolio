<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/entity/Entity.php');

class User extends Entity {

    private ?int $id;
    private string $name;
    private string $nickname;
    private string $username;
    private string $password;
    private string $mail;
    private ?string $phoneNumber;
    private int $validateAccount;
    private string $role;
    private ?string $accountKey;

    public function __construct(array $data = []) 
    {
        parent::__construct($data);
    }


/* ---------------------------- Getters -----------------------------*/

    public function getId() : ?int
    { 
        return (int) $this->id; 
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
        return (int) $this->validateAccount; 
    }

    public function getRole() : string
    { 
        return $this->role; 
    }

    public function getAccountKey() : string
    { 
        return $this->accountKey; 
    }

/* ---------------------------- Setters -----------------------------*/

    public function setId(int $id) : void
    {
            $this->id = $id;
    }

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

    public function setValidateAccount($validateAccount) : void
    {
        $this->validateAccount = (int) $validateAccount;
    }

    public function setRole(string $role) : void
    {
            $this->role = $role;
    }
    
    public function setAccountKey(string $accountKey) : void
    {
            $this->accountKey = $accountKey;
    }
}
