<?php

use Doctrine\ORM\Mapping as ORM;
/**
 *@ORM\Entity @ORM\Table(name="image")
 **/


class Image{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(50) NOT NULL") */
    private $name;

    /** @ORM\Column(type="string", columnDefinition="VARCHAR(25) NOT NULL") */
    private $size;

    /** @ORM\Column(type="string", columnDefinition="VARCHAR(25) NOT NULL") */
    private $type;

    /** @ORM\Column(type="blob") */
    private $imageData;

    /** @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**Many Image Belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="foto")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $related_post;

    #constructor
    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->imageData = $imageData;
    }

    public function setUser(User $user){
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }

    public function setPost(Post $post){
        $this->related_post = $post;
    }

    public function getPost(){
        return $this->related_post;
    }

}

//constructor and methods to add user and try it 