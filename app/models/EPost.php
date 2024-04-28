<?php

class EPost{

    //attributes
    private $idPost;

    private $title;

    private $description;

    private $category;

    private DateTime $creation_time; 

    private $removed = false;

    protected $user;

    private $images;

    private static $entity = EPost::class;

    //constructor
    public function __construct($title, $description, $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->setTime();
        $this->images = [];
        
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idPost;
    }

    public function setId($id){
        $this->idPost = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getTime()
    {
        return $this->creation_time;
    }
    
    private function setTime(){
        $this->creation_time = new DateTime("now");
    }

    public function getTimeStr()
    {
        return $this->creation_time->format('Y-m-d H:i:s');
    }

    public function setCreationTime($dateTime){
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

    public function setUser(EUser $user): void
    {
        $this->user = $user;
    }   

    public function getImages()
    {
        return $this->images;
    }

    public function addImage(EImage $image): void
    {
        $imageId = $image->getId(); // Assuming you have a method to get the image ID
    
        // Check if the image with the same ID exists in the images array
        $imageExists = false;
        foreach ($this->images as $existingImage) {
            if ($existingImage->getId() === $imageId) {
                $imageExists = true;
                break;
            }
        }

        // If the image doesn't exist in the array, add it
        if (!$imageExists) {
            $this->images[] = $image;
            $image->setPost($this);
        }
    }

    
}