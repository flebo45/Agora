<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="userFollow")
 */
class EUserFollow {
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idFollower;

    /**
     * @ORM\Column(type="integer")
     */
    protected $idFollowed;

    private static $entity = EUserFollow::class;


    public function __construct($followerId, $followedId) {
        $this->idFollower = $followerId;
        $this->idFollowed = $followedId;
    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getFollower()
    {
        return $this->idFollower;
    }

    public function getFollowed()
    {
        return $this->idFollowed;
    }

}