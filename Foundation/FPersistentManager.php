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
        $result = Fpost::loadPostInDb($post);

        return $result;
        
        // if exist 'UPDATE' else 'CREATE'
    }

    public function selectPost($postID){
        //perform query and return all data
    }

    public function deletePost($postID){
        //perform query via FPost and delete from the table
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