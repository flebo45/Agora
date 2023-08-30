<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */

class EPost{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idPost;

     /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $category;

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
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="EImage", mappedBy="post", cascade={"remove"})
     */
    private $images;


    private static $entity = EPost::class;

    private static $alias= 'post';

    public function __construct($title, $description, $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->setTime();
        $this->images = new ArrayCollection();
        
    }
    
    private function setTime(){
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
        return $this->idPost;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(EUser $user): void
    {
        $this->user = $user;
    }

    public function getTitle()
    {
        return $this->title;
    }

        public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function isRemoved(): bool
    {
        return $this->removed;
    }

    public function setRemoved(bool $removed): void
    {
        $this->removed = $removed;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(EImage $image): void
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPost($this);
        }
    }
}