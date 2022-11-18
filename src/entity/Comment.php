<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\entity;

use App\entity\Entity;

class Comment extends Entity {

    private ?int $id;
    private string $author;
    private string $content;
    private string $creationDate;
    private int $validateComment;
    private int $postId;
    private int $userId;

    public function __construct($data = []) 
    {
        parent::__construct($data);
    }

/* ---------------------------- Getters -----------------------------*/

    public function getId() : ?int
    { 
        return (int) $this->id; 
    }

    public function getAuthor() : string
    { 
        return $this->author; 
    }

    public function getContent() : string
    { 
        return $this->content; 
    }

    public function getCreationDate() : string
    { 
        return $this->creationDate; 
    }

    public function getValidateComment() : int
    { 
        return $this->validateComment; 
    }

    public function getPostId() : int
    { 
        return (int) $this->postId; 
    }

    public function getUserId() : int
    { 
        return (int) $this->userId; 
    }
    
/* ---------------------------- Setters -----------------------------*/

    public function setId(int $id) : void
    {
            $this->id = $id;
    }

    public function setAuthor(string $author) : void
    {
        if (strlen($author) < 50) {
            $this->author = $author;
        }
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function setCreationDate(string $creationDate) : void
    {
        $this->creationDate = $creationDate;
    }

    public function setValidateComment(int $validateComment) : void
    {
        $this->validateComment = (int) $validateComment;
    }

    public function setPostId(int $postId) : void
    {
        $this->postId = (int) $postId;
    }

    public function setUserId(int $userId) : void
    {
        $this->userId = (int) $userId;
    }
}
