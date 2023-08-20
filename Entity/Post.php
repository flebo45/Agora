<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /** @ORM\Column(type="datetime") */
    private DateTime $creation_time; 

    /**
    * @ORM\Column(type="boolean")
    */
    private $removed = false;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="ELike", mappedBy="post", cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="post", cascade={"remove"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="post", cascade={"remove"})
     */
    private $reports;


    public function __construct($title, $description, $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->setTime();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->reports = new ArrayCollection();
    }

    public function getId(): ?int
{
    return $this->id;
}

public function setTime(){
    $this->creation_time = new DateTime("now");
}

public function getTime(){
    return $this->creation_time;
}

public function getUser()
{
    return $this->user;
}

public function setUser(User $user): void
{
    $this->user = $user;
}

public function getComments()
{
    return $this->comments;
}

public function addComment(Comment $comment): void
{
    $this->comments[] = $comment;
}

public function getTitle()
{
    return $this->title;
}

public function setTitle($title): void
{
    $this->title = $title;
}

public function getDescription()
{
    return $this->description;
}

public function setDescription($description): void
{
    $this->description = $description;
}

public function getCategory()
{
    return $this->category;
}

public function setCategory($category): void
{
    $this->category = $category;
}

public function isRemoved(): bool
{
    return $this->removed;
}

public function setRemoved(bool $removed): void
{
    $this->removed = $removed;
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

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): void
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPost($this);
        }
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