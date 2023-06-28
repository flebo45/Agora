<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reports")
 */

class Report{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(255) NOT NULL") **/
    private $description;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(255) NOT NULL") **/
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post = null;

    /**
     * @ORM\ManyToOne(targetEntity="Comment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $comment = null;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    #constructor

    public function __construct(string $description, string $type, User $user)
    {
        $this->description = $description;
        $this->type = $type;
        $this->user = $user;
    }

    #methods

    public function setPost(Post $post){
        $this->post = $post;
    }

    public function setComment(Comment $comment){
        $this->comment = $comment;
    }

    public function getId(){
        return $this->id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getType(){
        return $this->type;
    }

    public function getPost(){
        return $this->post;
    }

    public function getComment(){
        return $this->comment;
    }

    public function getUser(){
        return $this->user;
    }

}