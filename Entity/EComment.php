<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class EComment{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idComment;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /** @ORM\Column(type="datetime") */
    private DateTime $creation_time;

    /**
    * @ORM\Column(type="boolean")
    */
    private $removed = false;

    /**
     * @ORM\ManyToOne(targetEntity="EUser")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     */
    private $user;

    /** 
     * @ORM\Column(type="integer") 
     * @ORM\OneToOne(targetEntity="EPost")
    **/
    private $idPost;

    private static $entity = EComment::class;

    private static $alias = 'comment';

    public function __construct($body, $user, $idPost)
    {
        $this->body = $body;
        $this->user = $user;
        $this->idPost = $idPost;
        $this->setTime();
    }

    private function setTime()
    {
        $this->creation_time = new DateTime("now");
    }

    public function getTime()
    {
        return $this->creation_time;
    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public static function getAlias(): string
    {
        return self::$alias;
    }

    public function getId()
    {
        return $this->idComment;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getIdPost()
    {
        return $this->idPost;
    }

    public function isRemoved(): bool
    {
        return $this->removed;
    }

    public function setRemoved(bool $removed): void
    {
        $this->removed = $removed;
    }
}