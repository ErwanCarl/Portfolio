<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\model;

use App\entity\Post;
use App\model\Model;
use \PDO;

class PostModel extends Model
{

    private const PostClass = 'App\entity\Post'; 

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
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::PostClass);
        return $statement->fetch();
    }

    public function postCreate(Post $post) : bool 
    {
        $statement = $this->connection->prepare("INSERT INTO post(author, title, chapo, content, user_id, picture) VALUES(:author, :title, :chapo, :content, :user_id, :picture)");
        $line = $statement->execute([
            'author' => $post->getAuthor(),
            'title' => $post->getTitle(),
            'chapo' => $post->getChapo(),
            'content' => $post->getContent(),
            'user_id' => $post->getUserId(),
            'picture' => $post->getPicture()
        ]);
        return $line;
    }

    public function postModification($id) : Post 
    {
        $statement = $this->connection->prepare("SELECT * FROM post WHERE id = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::PostClass);
        return $statement->fetch();
    }

    public function modifyRegister(Post $post) : bool 
    {
        if($post->getPicture() === null) {
            $statement = $this->connection->prepare("UPDATE post SET title = :title, chapo = :chapo, content = :content, modificationDate = NOW() WHERE id = :id");
        return $statement->execute([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'chapo' => $post->getChapo(),
            'content' => $post->getContent(),
        ]);
        }else{
            $statement = $this->connection->prepare("UPDATE post SET title = :title, chapo = :chapo, content = :content, modificationDate = NOW(), picture = :picture WHERE id = :id");
        return $statement->execute([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'chapo' => $post->getChapo(),
            'content' => $post->getContent(),
            'picture' => $post->getPicture()
        ]);
        }
    }

    public function postSuppression(int $id): bool
    {
        $statement = $this->connection->prepare("DELETE FROM post WHERE id = ?");
        return $statement->execute([$id]);
    }
}
