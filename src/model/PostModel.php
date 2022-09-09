<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/Model.php');
require_once('src/entity/Post.php');

class PostModel extends Model
{

/* Get all blogposts informations */

    public function getPosts(): array 
    {
        $statement = $this->connection->query("SELECT `id`, `title`,`author`,`chapo`,`creation_date` FROM `post` ORDER BY `creation_date` DESC");

        return $statement->fetchAll();
    }


/* Get and reach the choosen post with the id */

    public function getPost(int $id): Post 
    {
        $statement = $this->connection->prepare("SELECT `id`, `title`,`author`,`chapo`,`creation_date`, `content` FROM `post` WHERE `id` = ? ORDER BY `creation_date` DESC");
        
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
        return $statement->fetch();
    }

}