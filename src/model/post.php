<?php

/* Get all blogposts informations */

function getPosts(): array {
    try {
        $database = new PDO('mysql:host=localhost;dbname=blogpost;charset=utf8', 'root', 'Montpellier34090!');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
    }

    $statement = $database->query("SELECT `id`, `title`,`author`,`chapo`,`creation_date` FROM `post` ORDER BY `creation_date` DESC");

    return $statement->fetchAll();
}


/* Get and reach the choosen post with the id */

function getPost(string $id): array {
    try {
        $database = new PDO('mysql:host=localhost;dbname=blogpost;charset=utf8', 'root', 'Montpellier34090!');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
    }

    $statement = $database->prepare("SELECT `id`, `title`,`author`,`chapo`,`creation_date`, `content` FROM `post` WHERE `id` = ? ORDER BY `creation_date` DESC");
    $statement->execute([$id]);
    return $statement->fetch();

}