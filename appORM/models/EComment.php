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
     * @ORM\ManyToOne(targetEntity="EPost", inversedBy="comments")
     * @ORM\JoinColumn(name="idPost", referencedColumnName="idPost")
    **/
    private $post;

    private static $entity = EComment::class;

    public function __construct($body, $user)
    {
        $this->body = $body;
        $this->user = $user;
        $this->setTime();
    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    private function setTime()
    {
        $this->creation_time = new DateTime("now");
    }

    public function getTime()
    {
        return $this->creation_time;
    }

    public function getTimeStr()
    {
        return $this->creation_time->format('Y-m-d H:i:s');
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

    public function isBanned(): bool
    {
        return $this->removed;
    }

    public function setBan(bool $removed): void
    {
        $this->removed = $removed;
    }

    public function getPost(){
        return $this->post;
    }

    public function setPost(EPost $post){
        $this->post = $post;
    }
}