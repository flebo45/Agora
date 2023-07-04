<?php

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity @ORM\Table(name="comments")
 **/

class Comment{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(255) NOT NULL") **/
    private $body;

    /** @ORM\Column(type="datetime") */
    private DateTime $creation_time; 

    //If is reported and the admin remove it
    //** @ORM\Column(type="boolean", nullable=false, name ="is_deleted"}) */
    private bool $removed ;

    /** 
     * Many comments belong to a User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comment")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */
    private User|null $creator = null;

    /** 
     * Many comments belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
    private Post|null $related_post = null;

     /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="comment")
     */
    private $reports;

    #constructor
    public function __construct(string $body, User $creator, Post $related_post){
        $this->body = $body;
        $this->creator = $creator;
        $this->related_post = $related_post;
        $this->setTime();
        $this->removed = 0;
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    #methods
    public function getId(){
        return $this->id;
    }

    public function getBody(){
        return $this->body;
    }

    public function setTime(){
        $this->creation_time = new DateTime("now");
    }

    public function isRemoved(){
        return $this->removed;
    }

    public function remove(){
        $this->removed = 1;
    }

    public function addReport(Report $report){
        $this->reports[] = $report;
    }

    public function removeReport(Report $report){
        $this->reports->removeElement($report);
    }
    

}