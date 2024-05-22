<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="likes")
 */

class ELike{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idLike;

    /**
     * @ORM\ManyToOne(targetEntity="EUser")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="EPost")
     * @ORM\JoinColumn(name="idPost", referencedColumnName="idPost")
     */
    private $post;

    private static $entity = ELike::class;


    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idLike;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost(EPost $post){
        $this->post = $post;
    }
}