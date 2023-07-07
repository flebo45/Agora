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
    private User|null $creator_id = null;

    /** 
     * Many likes belong to a Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="elike")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
    private Post|null $post_id = null;




    #constructor
    public function __construct(User $creator, Post $related_post)
    {   
        $this->creator_id = $creator;
        $this->post_id = $related_post;
    }

    #methods

    public function getId(){

        return $this->id;
    }
     
}