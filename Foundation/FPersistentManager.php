<?php
//singleton class
class FPersistentManager{
    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FPersistentManager();
        }

        return self::$instance;
    }

    public function loadPost($post){
        //call to Fpost to do a query to update the db
        //Fpost need to check if the post already exist or notù
        // if exist 'UPDATE' else 'CREATE'
    }

    public function selectPost($userID, $postID){
        //perform query and return all data
    }

    public function deletePost($userID, $postID){
        //perform query via FPost and delete from the table
    }


}


?>