<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\Agora\Control\CUser.php');
require_once(__ROOT__.'\Agora\Entity\EPost.php');
require_once(__ROOT__.'\Agora\Foundation\FPersistentManager.php');
class CManagePost{

    //constructor
    public function __construct(){

    }

    //methods
    public static function showForm(){
        //verify if User is logged 
        if(CUser::isLogged()){
            
            //call to a view that show the form page
        }
        else{
            //show the homepage of non registered user
        }

    }

    public function newSketch(){
        //verify if the user is logged
      
        $userID = $_SESSION['userID'];

        //other value are taken by a viewClass 

        //test data
        $title = 'Title';
        $body = 'Body';
        $category = 'Category';
        $creationDate = date("Y/m/d");
        $creationTime = date("h:i:sa");
        $postID = 'postId';

        //data will be stored in the session 
        //and we call the view to show the sketch

        //$post = new Epost($postID, $title, $body, $category, 0, $userID, null, $creationDate, $creationTime);

        //return $post;

        }

    public function loadPost(){
            //check if the user is logged
        //take the data from the _SESSION[] and create EPost obj

        //test data
        $userID = $_SESSION['userID'];
        $title = 'Title';
        $body = 'Body';
        $category = 'Category';
        $creationDate = date("Y/m/d");
        $creationTime = date("h:i:sa");
        $postID = 'postId';

        $post = new Epost($postID, $title, $body, $category, 0, $userID, null, $creationDate, $creationTime);

        //the post will be stored in the db

        //call to PM
        $pm = FPersistentManager::getInstance();

        //PM call FPost to compute data and give the result
        $pm->loadPost($post);

            //else header('')
    }

    //tasto annulla
    public function undoSketch(){
        //check if the user is logged 
        //call to the view that show the form 
        // fill the form with the __SESSION data 
    }

    public function modifyPost($postID){
        //check if the user is logged
        //call to PM
        $pm = FPersistentManager::getInstance();

        //PM call to FPost tho perform query and return Post info
        $post = $pm->selectPost($postID);
        //probably we need to serialize and unserialize

        //save the data in the __SESSION
        //call to the view that show the form that will fill the form
    }

    public function deletePost($postID){
        //check if the user is logged
        //call to PM
        $pm = FPersistentManager::getInstance();

        $pm->deletePost($postID);
    }


    $pm = FPersistentManager::getInstance();

    $userId = USession::getSessionElement('user');

    $user = $pm::retriveUser($id);
}

?>