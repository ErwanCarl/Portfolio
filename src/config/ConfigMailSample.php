<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\config;

abstract class ConfigMail 
{
    private string $host = 'host';
    private string $username = 'username';
    private string $password = 'password';

    public function getHost() : string
    {
        return $this->host;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getPassword() : string
    {
        return $this->password;
    }
}
