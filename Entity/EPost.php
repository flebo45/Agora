<?php

class EPost{
    private $postID;

    private String $title;

    private string $body;

    private string $category;

    private int $nLike;

    private $userID;

    private $commentsList;

    private $creationDate;

    private $creationTime;

    public function __construct($postID, $title, $body, $category, $nLike, $userID, $commentsList, $creationDate, $creationTime){
        $this->postID = $postID;
        $this->title = $title;
        $this->body = $body;
        $this->category = $category;
        $this->nLike = $nLike;
        $this->userID = $userID;
        $this->commentsList = $commentsList;
        $this->creationDate = $creationDate;
        $this->creationTime = $creationTime;
    }


    
}


?>