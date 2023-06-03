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


?>