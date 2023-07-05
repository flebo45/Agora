<?php

class FPersistentManager{

    /**
     * Singleton Class
     */

     private static $instance;

     public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * call to FPost to update Post table
     */

    public function loadPost(Post $post){
        $result = FPost::loadPostInDb($post);

        return $result;
    }

    /**
     *  call to FPost to delete obj in the db
     */
    public function deletePost(Post $post){

        $result = FPost::deletePostInDb($post);

        return $result;
        
    }

    public function selectPost($postID){
        //perform query and return all data
    }


    public function search($keyword){
        //perform query via FUser and FPost and take result
        // result is am array of item
    }

    public function selectUser($userID){
        //perform query via FUser and take result
    }

    public function loadReport($reportID){
        //call to FReport that update report table
    }

    public function reportTable(){
        //perform a query via FReport 
    }

    public function unsetReport(){
        //update Report Table via FReport
    }

    

}