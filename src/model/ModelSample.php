<?php

declare(strict_types=1);

namespace App\model;

use \PDO;

class Model 
{
    public ?PDO $connection = null;

    public function __construct() 
    {
    	if ($this->connection === null) {
        	$this->connection = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'username', 'password');
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
}
