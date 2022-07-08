<?php 

/* get all comments from a post thanks to its id */

function getComments (string $id) : array {

    try {
        $database = new PDO('mysql:host=localhost;dbname=blogpost;charset=utf8', 'root', 'Montpellier34090!');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
    }

    $statement = $database->prepare("SELECT `author`,`content`,`creation_date` FROM `comment` WHERE `post_id` = ? ORDER BY `creation_date` DESC");
    $statement->execute([$id]);
    return $statement->fetchAll();
}


/* register a new comment in db */

function createComment(string $id, string $author, string $content) : bool {

    try {
        $database = new PDO('mysql:host=localhost;dbname=blogpost;charset=utf8', 'root', 'Montpellier34090!');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
    }

    $statement = $database->prepare("INSERT INTO `comment`(`post_id`, `author`,`content`,`creation_date`) VALUES(:post_id, :author, :content, NOW())");
    $line = $statement->execute([
        'post_id' => $id,
        'author' => $author,
        'content' => $content
    ]);
    return ($line > 0);
}

