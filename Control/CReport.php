<?php

class CReport{

    public function showReportForm($id){
        if(CUser::isLogged()){
        //check if is postID or commentID
         //se post
         $postID = $_SESSION[$id];

         //se user
         $userID = $_SESSION[$id];

         //show form of report
        }
        else {
            //header
        }
    }

    public function confirmReport(){
        if(CUser::isLogged()){
            //take data from the view 
            //take id from the session
            //create reportID
            $pm = FPersistentManager::getInstance();
            $pm->loadReport($reportID);

            //header homepage
        }
        else{
            //header
        }
    }
    public function deleteReport(){
        if(CUser::isLogged()){
            //unset userid from _SESSION
            //header homepage
        }
        else{
            //header
        }
    }

}