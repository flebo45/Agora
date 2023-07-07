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
    //** @ORM\Column(type="boolean", nullable=false, name ="is_deleted"}, cascade={"persist", "remove" }) */
    private bool $is_delated;

    /** 
     * Many comments belong to a User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comment", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */
    private User|null $creator_id = null;

    /** 
     * Many comments belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
    private Post|null $post_id = null;

     /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="comment", cascade={"persist", "remove" })
     */
    private $reports;

    #constructor
    public function __construct(string $body, User $creator, Post $related_post){
        $this->body = $body;
        $this->creator_id = $creator;
        $this->post_id = $related_post;
        $this->setTime();
        $this->is_delated = 0;
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
        return $this->is_delated;
    }

    public function remove(){
        $this->is_delated = 1;
    }

    public function addReport(Report $report){
        $this->reports[] = $report;
    }

    public function removeReport(Report $report){
        $this->reports->removeElement($report);
    }
    

}