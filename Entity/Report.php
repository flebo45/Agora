<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reports")
 */
class Report
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
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Post")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="Comment")
     */
    private $comment;

    public function __construct($description, $type, User $user)
    {   
        $this->description = $description;
        $this->type = $type;
        $this->user = $user;
    }

    public function getId(){
        return $this->id;
    }

    public function getPost(){
        return $this->post;
    }

    public function setPost(Post $post){
        $this->post = $post;
    }

    public function getComment(){
        return $this->comment;
    }

    public function setComment(Comment $comment){
        $this->comment = $comment;
    }

    public function onPreRemove(): void
    {
        if ($this->user) {
            $this->user->getReports()->removeElement($this);
        }

        if ($this->post) {
            $this->post->getReports()->removeElement($this);
        }

        if ($this->comment) {
            $this->comment->getReports()->removeElement($this);
        }
    }
}