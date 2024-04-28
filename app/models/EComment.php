<?php

class EComment{

    //attributes
    private $idComment;

    private $body;

    private DateTime $creation_time;

    private $removed = false;

    private $user;

    private $idPost;

    private static $entity = EComment::class;

    //constructor
    public function __construct($body, $user, $idPost)
    {
        $this->body = $body;
        $this->user = $user;
        $this->idPost = $idPost;
        $this->setTime();
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idComment;
    }

    public function setId($id)
    {
        $this->idComment = $id;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getTime()
    {
        return $this->creation_time;
    }

    private function setTime()
    {
        $this->creation_time = new DateTime("now");
    }

    public function getTimeStr()
    {
        return $this->creation_time->format('Y-m-d H:i:s');
    }

    public function setCreationTime(DateTime $dateTime){
        $this->creation_time = $dateTime;
    }

    public function isBanned(): bool
    {
        return $this->removed;
    }

    public function setBan(bool $removed): void
    {
        $this->removed = $removed;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getIdPost()
    {
        return $this->idPost;
    }   
}