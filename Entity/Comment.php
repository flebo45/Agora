<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /** @ORM\Column(type="datetime") */
    private DateTime $creation_time;

    /**
    * @ORM\Column(type="boolean")
    */
    private $removed = false;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;

    /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="comment", cascade={"remove"})
     */
    private $reports;

    public function __construct($body, User $user, Post $post)
{
    $this->body = $body;
    $this->user = $user;
    $this->post = $post;
    $this->setTime();
    $this->reports = new ArrayCollection();
}

    public function getId(): ?int
{
    return $this->id;
}

public function setTime(){
    $this->creation_time = new DateTime("now");
}

public function getUser()
{
    return $this->user;
}

public function setUser(User $user): void
{
    $this->user = $user;
}

public function getPost()
{
    return $this->post;
}

public function setPost(Post $post): void
{
    $this->post = $post;
}

public function getBody()
{
    return $this->body;
}

public function setBody($body): void
{
    $this->body = $body;
}

public function isRemoved(): bool
{
    return $this->removed;
}

public function setRemoved(bool $removed): void
{
    $this->removed = $removed;
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