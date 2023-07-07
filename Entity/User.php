<?php

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 *@ORM\Entity @ORM\Table(name="user")
 **/

class User
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(30) NOT NULL") **/
    protected $name;

     /** @ORM\Column(type="string", columnDefinition="VARCHAR(30) NOT NULL") **/
     protected $surname;

      /** @ORM\Column(type="integer") **/
    protected $age;

      /** @ORM\Column(type="string", columnDefinition="VARCHAR(50) NOT NULL") **/
    protected $email;

      /** @ORM\Column(type="string", columnDefinition="CHAR(64) NOT NULL") */
    protected $hashedPassword;

      /** @ORM\Column(type="string", columnDefinition="VARCHAR(30) NOT NULL") */
    protected $username;

    //attributes after creation of Object

      /** @ORM\Column(type="string", nullable="true") */
    private $bio;

    /** @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image_id;

    /** @ORM\Column(type="integer") **/
    private $vip;

    /**@ORM\ManyToMany(targetEntity="User", mappedBy="followed", cascade={"persist", "remove" })
     * @var Collection<int, User>
     */
    private Collection $follower;

    /** 
     *  @var Collection<int, User>
     *  @ORM\JoinTable(name="follow")
     *  @ORM\JoinColumn(name="user_id", referencedColumnName="Id")
     * @ORM\ManyToMany(targetEntity="User", inversedBy="follower")
     */
    private Collection $followed;

    /**
     * One User has many Posts
     * @var Collection<int, Post>
     * @ORM\OneToMany(targetEntity="Post", mappedBy="creator", cascade={"persist", "remove" })
     */
    private Collection $post;

    /**
     * One User like many post (One User have many like)
     * @var Collection<int, ELike>
     * @ORM\OneToMany(targetEntity="ELike", mappedBy="creator", cascade={"persist", "remove" })
     */
    private Collection $elike;

      /**
     * One User comments many post (One User have many comments)
     * @var Collection<int, Comment>
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="creator", cascade={"persist", "remove" })
     */
    private Collection $comment;

    /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="user", cascade={"persist", "remove" })
     */
    private $reports;


    /** @ORM\Column(type="integer") **/
    private $reported;

    /** @ORM\Column(type="integer") **/
    private $banned;

    #constructor
    public function __construct(string $name, string $surname, int $age,  string $email, string $username, string $password)
    {
        $hashedPassword = hash('sha256', $password);

        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->email = $email;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->reported = 0;
        $this->vip = 0; 
        $this->banned = 0;
        $this->follower = new \Doctrine\Common\Collections\ArrayCollection();
        $this->followed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
        $this->elike = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
    }



    # Accessors
    public function getId() : mixed { return $this->id; }
    public function getName() : string { return $this->name; }
    public function getSurname() : string { return $this->surname; }
    public function getAge() : int { return $this->age; }
    public function getEmail() : string { return $this->email; }
    public function addFollowedUser(User $user){

        $this->followed[] = $user;
    }

    public function getHashedPassword() : string { return $this->hashedPassword; }

    public function setPassword($password){
      $hashedPassword = hash('sha256', $password);
      $this->hashedPassword = $hashedPassword;
    }

    public function getUsername() : string { return $this->username; } 

    public function setUsername($username){
      $this->username = $username;
    }

    public function getBio() : string { return $this->bio; }

    
    public function setBio($bio){
        $this->bio = $bio;
    }

    public function setProPic(Image $pic){
      $this->image_id = $pic;
    }

    public function isBanned(){
      return $this->banned;
    }

    public function setBanned(){
      $this->banned = 1;
    }

    public function isVIP(){
        return $this->vip;
    }

    public function setVIP(){
        $this->vip = 1;
    }

    public function getReport(){
      return $this->reported;
    }

    public function addReport(){
      $this->reported += 1;
    }

    public function addPost(Post $post){
        $this->post[] = $post;
    }

    public function removePost(Post $post){
        $this->post->removeElement($post);
    }

    public function addLike(ELike $like){
        $this->elike[] = $like;
  }

    public function removeLike(ELike $like){
      $this->elike->removeElement($like);
    }

    public function addComment(Comment $comment){
      $this->comment[] = $comment;
}

public function addReports(Report $report){
  $this->reports[] = $report;
}
public function removeReported(Report $report){
  $this->reports->removeElement($report);
}



}