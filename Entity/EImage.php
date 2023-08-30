<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 */

 class EImage{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idImage;

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
     * @ORM\ManyToOne(targetEntity="EPost", inversedBy="image")
     * @ORM\JoinColumn(name="idPost", referencedColumnName="idPost")
     */
    private $post;


    private static $entity = EImage::class;

    private static $alias= 'image';

    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->imageData = $imageData;
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
        return $this->idImage;
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

    public function getImageData()
    {
        return $this->imageData;
    }

    public function getEncodedData(){
        return base64_encode(stream_get_contents($this->imageData));
    }

    public function setPost(EPost $post): void
    {
        $this->post = $post;
    }

    public function getPost(): ?EPost
    {
        return $this->post;
    }
}