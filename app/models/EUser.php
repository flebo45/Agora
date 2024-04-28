<?php
require_once("EPerson.php");

class EUser extends EPerson{

    //attributes
    protected $ban = false;

    protected $vip = false;

    protected $biography;

    protected $working;

    protected $studiedAt;

    protected $hobby;

    protected $idImage;

    protected $warnings;

    public $discr = "user";

    private static $entity = EUser::class;

    //constructor
    public function __construct($name,$surname, $year, $email, $password, $username)
    {
        parent::__construct($name, $surname, $year, $email, $password, $username);
        $this->biography = null;
        $this->studiedAt = null;
        $this->hobby = null;
        $this->warnings = 0;

    }

    //methods
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

    public function getIdImage()
    {
        return $this->idImage;
    }

    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;
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

}