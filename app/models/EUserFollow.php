<?php

class EUserFollow {

    //attributes
    private $id;

    private $idFollower;

    protected $idFollowed;

    private static $entity = EUserFollow::class;

    //constructor
    public function __construct($followerId, $followedId) {
        $this->idFollower = $followerId;
        $this->idFollowed = $followedId;
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getFollower()
    {
        return $this->idFollower;
    }

    public function getFollowed()
    {
        return $this->idFollowed;
    }
}