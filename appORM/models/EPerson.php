<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"person" = "EPerson", "user" = "EUser", "moderator" = "EModerator"})
 */

class EPerson{

    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * 
     */
    protected $idUser;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $surname;

    /**
     * @ORM\Column(type="integer")
     */
    protected $year;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $username;


    public $discr = "person";

    private static  $entity = EPerson::class;

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

    public static function getEntity(): string
    {
        return self::$entity;
    }

    public function getId()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
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

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
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