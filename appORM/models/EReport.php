<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="report")
 */

 class EReport{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idReport;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="EPost")
     * @ORM\JoinColumn(name="idPost", referencedColumnName="idPost", onDelete="CASCADE")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="EComment")
     * @ORM\JoinColumn(name="idComment", referencedColumnName="idComment", onDelete="CASCADE")
     */
    private $comment;

    private static $entity = EReport::class;

    public function __construct($description, $type, $idUser)
    {   
        $this->description = $description;
        $this->type = $type;
        $this->idUser = $idUser;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idReport;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost(EPost $post)
    {
        $this->post = $post;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment(EComment $comment)
    {
        $this->comment = $comment;
    }

 }