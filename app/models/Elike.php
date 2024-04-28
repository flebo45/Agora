<?php

class ELike{

    //attributes
    private $idLike;

    private $idUser;

    private $idPost;

    private static $entity = ELike::class;

    //constructor
    public function __construct($idUser, $idPost)
    {
        $this->idUser = $idUser;
        $this->idPost = $idPost;
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idLike;
    }

    public function setId($id)
    {
        $this->idLike = $id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getIdPost()
    {
        return $this->idPost;
    }   
}