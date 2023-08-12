<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="blob")
     */
    private $imageData;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="images")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="images")
     */
    private $post;

    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->imageData = $imageData;
    }

    public function getId(){
        return $this->id;
    }

    public function setUser(User $user = null): void
    {
        $this->user = $user;
    }

    public function setPost(Post $post = null): void
    {
        $this->post = $post;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getimageData()
    {
        return $this->imageData;
    }
}