<?php

/* To have a strict use of variable types */
declare(strict_types=1);

class Comment {

    private $id;
    private $author;
    private $content;
    private $creationDate;
    private $validateComment;
    private $postId;
    private $userId;

    public function __construct($data) 
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data) : void
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

/* ---------------------------- Getters -----------------------------*/

    public function getId() : int
    { 
        return $this->id; 
    }

    public function getAuthor() : string
    { 
        return $this->author; 
    }

    public function getContent() : string
    { 
        return $this->content; 
    }

    public function getCreationDate()
    { 
        return $this->creationDate; 
    }

    public function getValidateComment() : int
    { 
        return $this->validateComment; 
    }

    public function getPostId() : int
    { 
        return $this->postId; 
    }

    public function getUserId() : int
    { 
        return $this->userId; 
    }
    
/* ---------------------------- Setters -----------------------------*/

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

    public function setCreationDate($creationDate) : void
    {
        $this->creationDate = $creationDate;
    }

    public function setValidateComment($validateComment) : void
    {
        $this->validateComment = $validateComment;
    }

    public function setPostId($postId) : void
    {
        $this->postId = $postId;
    }

    public function setUserId($userId) : void
    {
        $this->userId = $userId;
    }

}