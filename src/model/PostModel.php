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
        $statement = $this->connection->query("SELECT `id`, `title`,`author`,`chapo`,`creationDate`, `modificationDate`, `picture` FROM `post` ORDER BY `creationDate` DESC");

        return $statement->fetchAll();
    }

    public function getPostsHomepage(): array 
    {
        $statement = $this->connection->query("SELECT `id`, `title`,`author`,`chapo`,`creationDate`, `modificationDate`, `picture` FROM `post` ORDER BY `creationDate` DESC LIMIT 3");

        return $statement->fetchAll();
    }

/* Get and reach the choosen post with the id */

    public function getPost(int $id): Post 
    {
        $statement = $this->connection->prepare("SELECT `id`, `title`,`author`,`chapo`,`creationDate`, `content`, `modificationDate`, `picture` FROM `post` WHERE `id` = ? ORDER BY `creationDate` DESC");
        
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
        return $statement->fetch();
    }

    // Pas oublier de rajouter colonne picture à insert quand dev done
    public function postCreate(Post $post) : bool 
    {
        $statement = $this->connection->prepare("INSERT INTO post(author, title, chapo, content, user_id) VALUES(:author, :title, :chapo, :content, :user_id)");
        $line = $statement->execute([
            'author' => $post->getAuthor(),
            'title' => $post->getTitle(),
            'chapo' => $post->getChapo(),
            'content' => $post->getContent(),
            'user_id' => $post->getUserId()
        ]);
        return $line;
    }

    public function postModification($id) : Post 
    {
        $statement = $this->connection->prepare("SELECT * FROM post WHERE id = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
        return $statement->fetch();
    }

    public function modifyRegister(Post $post) : bool 
    {
        $statement = $this->connection->prepare("UPDATE post SET title = :title, chapo = :chapo, content = :content, modificationDate = NOW() WHERE id = :id");
        return $statement->execute([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'chapo' => $post->getChapo(),
            'content' => $post->getContent(),
        ]);
    }

    public function postSuppression(int $id): bool
    {
        $statement = $this->connection->prepare("DELETE FROM post WHERE id = ?");
        return $statement->execute([$id]);
    }


}