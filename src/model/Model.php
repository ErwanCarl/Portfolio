<?php

declare(strict_types=1);

class Model 
{
    public ?PDO $connection = null;

    public function __construct() 
    {
    	if ($this->connection === null) {
        	$this->connection = new PDO('mysql:host=localhost;dbname=blogpost;charset=utf8', 'root', 'Montpellier34090!');
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
}
