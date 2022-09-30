<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/entity/Entity.php');

class Post extends Entity
{
    private ?int $id;
    private string $title;
    private string $author;
    private string $content;
    private string $chapo;
    private $creationDate;
    private $modificationDate;
    private ?string $picture;
    private int $userId;

    public function __construct($data = []) 
    {
        parent::__construct($data);
        $this->creationDate = new \DateTimeImmutable('now');
    }


/* ---------------------------- Getters -----------------------------*/

    public function getId() : ?int
    { 
        return (int) $this->id; 
    }

    public function getTitle() : string
    { 
        return $this->title;
    }

    public function getAuthor() : string
    { 
        return $this->author; 
    }

    public function getContent() : string
    { 
        return $this->content; 
    }

    public function getChapo() : string
    { 
        return $this->chapo;
    }

    public function getCreationDate() 
    { 
        return $this->creationDate; 
    }

    public function getModificationDate() 
    { 
        return $this->modificationDate; 
    }

    public function getPicture() : string
    { 
        return $this->picture; 
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

    public function setTitle(string $title) : void
    {
        if (strlen($title) < 50) {
            $this->title = $title;
        }
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

    public function setChapo(string $chapo) : void
    {
        if (strlen($chapo) < 255) {
            $this->chapo = $chapo;
        }
    }

    public function setCreationDate($creationDate) : void
    {
        $this->creationDate = $creationDate;
    }

    public function setModificationDate($modificationDate) : void
    {
        $this->modificationDate = $modificationDate;
    }

    public function setPicture(string $picture) : void
    {
        $this->picture =  $picture;
    }

    public function setUserId(int $userId) : void
    {
        $this->userId = (int) $userId;
    }

}