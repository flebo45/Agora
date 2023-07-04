<?php

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity @ORM\Table(name="moderators")
 **/

class Moderator{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

     /** @ORM\Column(type="string", columnDefinition="VARCHAR(30) NOT NULL") */
     protected $username;

    /** @ORM\Column(type="string", columnDefinition="VARCHAR(50) NOT NULL") **/
    protected $email;

    /** @ORM\Column(type="string", columnDefinition="CHAR(64) NOT NULL") */
    protected $hashedPassword;

    #constructor

    public function __construct(string $username, string $email, string $password){
        
        $hashedPassword = hash('sha256', $password);
        $this->username = $username;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
    }

    #methods

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getHashedPassword(){
        return $this->hashedPassword;
    }

    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPassword(string $password){
        $hashedPassword = hash('sha256', $password);
        $this->hashedPassword = $hashedPassword;
    }


}