<?php

class EReport{

    //attributes
    private $idReport;

    private $description;

    private $type;

    private $idUser;

    private $post;

    private $comment;

    private static $entity = EReport::class;

    //constructor
    public function __construct($description, $type, $idUser)
    {   
        $this->description = $description;
        $this->type = $type;
        $this->idUser = $idUser;
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idReport;
    }

    public function setId($id){
        $this->idReport = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost(EPost $post)
    {
        $this->post = $post;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment(EComment $comment)
    {
        $this->comment = $comment;
    }
 }