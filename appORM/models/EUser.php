<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
require_once("EPerson.php");

/**
 * @ORM\Entity 
 * @ORM\Table(name="user")
 */

class EUser extends EPerson{

    /**
    * @ORM\Column(type="boolean")
    */
    protected $ban = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $vip = false;

    /**
    * @ORM\Column(type="text", nullable=true)
    */
    protected $biography;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $working;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $studiedAt;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $hobby;

    /** 
     * @ORM\Column(type="integer", nullable=true) 
    **/
    public $idImage;

    /**
     * @ORM\Column(type="integer")
     */
    protected $warnings;

    /**
     * @ORM\OneToMany(targetEntity="EPost", mappedBy="user", cascade={"persist","remove"})
     */
    private $posts;


    public $discr = "user";

    private static $entity = EUser::class;

    public function __construct($name,$surname, $year, $email, $password, $username)
    {
        parent::__construct($name, $surname, $year, $email, $password, $username);
        $this->biography = null;
        $this->studiedAt = null;
        $this->hobby = null;
        $this->warnings = 0;
        $this->posts = new ArrayCollection();
        $this->idImage = 1;

    }

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function isBanned()
    {
        return $this->ban;
    }

    public function setBan($bool)
    {
        $this->ban = $bool;
    }

    public function isVip()
    {
        return $this->vip;
    }

    public function setVip($bool)
    {
        $this->vip = $bool;
    }

    public function getBio()
    {
        return $this->biography;
    }

    public function setBio($biography)
    {
        $this->biography = $biography;
    }
    
    public function getWorking()
    {
        return $this->working;
    }

    public function setWorking($working)
    {
        $this->working = $working;
    }

    public function getStudiedAt()
    {
        return $this->studiedAt;
    }

    public function setStudiedAt($studiedAt)
    {
        $this->studiedAt = $studiedAt;
    }

    public function getHobby()
    {
        return $this->hobby;
    }

    public function setHobby($hobby)
    {
        $this->hobby = $hobby;
    }

    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;
    }

    public function getIdImage()
    {
        return $this->idImage;
    }

    public function getWarnings()
    {
        return $this->warnings;
    }

    public function setWarnings(){
        $this->warnings = $this->warnings + 1;
    }

    public function setWarning($warning){
        $this->warnings = $warning;
    }

    public function getPosts(){
        return $this->posts;
    }

    public function addPost(EPost $post){
        $this->posts[] = $post;
        $post->setUser($this);
    }

}
