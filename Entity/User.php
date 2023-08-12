<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $hashedPassword;

    /**
    * @ORM\Column(type="text", nullable=true)
    */
    private $bio;

    /**
    * @ORM\Column(type="boolean")
    */
    private $banned = false;

    /**
    * @ORM\Column(type="boolean")
    */
    private $vip = false;


    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="followers")
     * @ORM\JoinTable(name="user_follows")
     */
    private $followedUsers;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="followedUsers")
     */
    private $followers;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="ELike", mappedBy="user", cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\OneToOne(targetEntity="Image", mappedBy="user", cascade={"persist", "remove"})
     */
    private $profileImage;

    /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="user")
     */
    private $reports;



    public function __construct(string $name, string $surname, int $age,  string $email, string $username, string $password)
    {
        $hashedPassword = hash('sha256', $password);

        $this->profileImage = null;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->email = $email;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->bio = null;
        $this->followers = new ArrayCollection();
        $this->followedUsers = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->reports = new ArrayCollection();

    }

    public function getId(): ?int
{
    return $this->id;
}

public function getFollowedUsers()
{
    return $this->followedUsers;
}

private function addFollowedUser(User $followedUser): void
{
    if (!$this->followedUsers->contains($followedUser)) {
        $this->followedUsers[] = $followedUser;
    }
}
private function addFollower(User $follower): void
{
    if (!$this->followers->contains($follower)) {
        $this->followers[] = $follower;
    }
}

public function follow(User $userToFollow): void
{
    $userToFollow->addFollower($this);
    $this->addFollowedUser($userToFollow);
}

public function getFollower()
{
    return $this->followers;
}


public function getPosts()
{
    return $this->posts;
}

public function addPost(Post $post): void
{
    $this->posts[] = $post;
}

public function getName()
{
    return $this->name;
}

public function getSurname()
{
    return $this->surname;
}

public function getAge()
{
    return $this->age;
}

public function getEmail()
{
    return $this->email;
}

public function getUsername()
{
    return $this->username;
}

public function setUsername($username): void
{
    $this->username = $username;
}

public function getHashedPassword()
{
    return $this->hashedPassword;
}

public function setPassword($password)
{
    $hashedPassword = hash('sha256', $password);
    $this->hashedPassword = $hashedPassword;

}

public function getBio(): ?string
{
    return $this->bio;
}

public function setBio(?string $bio): void
{
    $this->bio = $bio;
}

public function isBanned(): bool
{
    return $this->banned;
}

public function setBanned(bool $banned): void
{
    $this->banned = $banned;
}

public function isVip(): bool
{
    return $this->vip;
}

public function setVip(bool $vip): void
{
    $this->vip = $vip;
}

public function addLike(ELike $like): void
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
        }
    }


    /**
     * @return Collection|ELike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function setProfileImage(Image $profileImage = null): void
    {
        $this->profileImage = $profileImage;
    }

    public function getProfileImage(): ?Image
    {
        return $this->profileImage;
    }

    public function addReport(Report $report){
        $this->reports[] = $report;
    }
    
    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

}