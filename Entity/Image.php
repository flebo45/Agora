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

    /** @ORM\OneToOne(targetEntity="User", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user_id;

    /**Many Image Belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="foto", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post_id;

    #constructor
    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->imageData = $imageData;
    }

    public function setUser(User $user){
        $this->user_id = $user;
    }

    public function getUser(){
        return $this->user_id;
    }

    public function setPost(Post $post){
        $this->post_id = $post;
    }

    public function getPost(){
        return $this->post_id;
    }

}