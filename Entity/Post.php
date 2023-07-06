<?php

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity @ORM\Table(name="post")
 **/

class Post{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    private $id;

    /**  @ORM\Column(type="string", columnDefinition="VARCHAR(100) NOT NULL") **/
    private $title;

    /**  @ORM\Column(type="string", columnDefinition="MEDIUMTEXT NOT NULL") **/
    private $description;

     /**  @ORM\Column(type="string", columnDefinition="VARCHAR(20) NOT NULL") **/
    private $category;

    /** @ORM\Column(type="datetime") */
    private DateTime $creation_time; 

    /** @ORM\Column(type="integer") **/
    private $removed;
    
    /**
      * Many Post have one User 
      * @ORM\ManyToOne(targetEntity="User", inversedBy="post")
      * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */
    private User|null $creator = null;

    /**
     * One Post have Many like 
     * @var Collection<int, ELike>
     * @ORM\OneToMany(targetEntity="ELike", mappedBy="related_post")
     */
    private Collection $elike;

    /**
     * One Post have Many comments 
     * @var Collection<int, Comment>
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="related_post")
     */
    private Collection $comment;

    /**
     * One Post has many foto
     * @var Collection<int, Image>
     * @ORM\OneToMany(targetEntity="Image", mappedBy="related_post")
     */
    private Collection $foto;

     /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="post")
     */
    private $reports;

    #constructor
    public function __construct(string $title, string $description, string $category)
    {   
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->setTime();
        $this->removed = 0;
        $this->elike = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->foto = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    #methods
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory(string $category){
        $this->category = $category;
    }

    public function setTime(){
        $this->creation_time = new DateTime("now");
    }

    public function isRemoved(){
        return $this->removed;
    }

    public function setRemove(){
        $this->removed = 1;
    }

    public function setCreator(User $creator){
        $this->creator = $creator;
    }

    public function removeCreator(){
        $this->creator = null;
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

    public function addImage(Image $image){
        $this->foto[] = $image;
    }

    public function removeImage(Image $image){
        $this->foto->removeElement($image);
    }

    public function addReport(Report $report){
        $this->reports[] = $report;
    }

    public function removeReport(Report $report){
        $this->reports->removeElement($report);
    }

}