<?php

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity @ORM\Table(name="Elike")
 **/

class ELike{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

    /** 
     * Many likes belong to a User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="elike")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */
    private User|null $creator = null;

    /** 
     * Many likes belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="elike")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
    private Post|null $related_post = null;




    #constructor
    public function __construct(User $creator, Post $related_post)
    {   
        $this->creator = $creator;
        $this->related_post = $related_post;
    }

    #methods

    public function getId(){

        return $this->id;
    }
     
}