<?php

class EPerson{

    //attributes
    protected $idUser;

    protected $name;

    protected $surname;

    protected $year;

    protected $email;

    protected $password;

    protected $username;

    public $discr = "person";

    private static  $entity = EPerson::class;

    //constructor
    public function __construct($name,$surname, $year, $email, $password, $username)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->name = $name;
        $this->surname = $surname;
        $this->year = $year;
        $this->email = $email;
        $this->password = $hashedPassword;
        $this->username = $username;
    }

    //methods
    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idUser;
    }

    public function setId($id)
    {
        $this->idUser = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
    }

    public function setHashedPassword($hashedPassword)
    {
        $this->password = $hashedPassword;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
}