<?php

class CReport{

    /**
     * Report a comment 
     * @param int $idComment Refers to the id of the comment
     */
    public static function reportComment($idComment)
    {
        if(CUser::isLogged()){
            $idUser = USession::getInstance()->getSessionElement('user');

            $reportedComment = FPersistentManager::getInstance()->retriveObj(FComment::getClass(), $idComment);
            if($reportedComment !== null){
                //create a new Report Obj and persist it
                $report = new EReport('', 'linguaggio scurrile', $idUser);
                $report->setComment($reportedComment);
                FPersistentManager::getInstance()->uploadObj($report);
                header('Location: /Agora/Post/visit/' . $reportedComment->getIdPost());
            }else{
                header('Location: /Agora/User/home');
            }     
        }   
    }

    /**
    * this method is called when a user report a Post 
    * @param int $idPost Refers to the id of a post 
    */
    public static function reportPost($idPost){
        if(CUser::isLogged()){
            $idUser = USession::getInstance()->getSessionElement('user');

            $reportedPost = FPersistentManager::getInstance()->retriveObj(FPost::getClass(), $idPost);
            if($reportedPost !== null){
                //create a new Report Obj and persist it
                $report = new EReport(UHTTPMethods::post('description'), UHTTPMethods::post('type'), $idUser);
                $report->setPost($reportedPost[0]);
                FPersistentManager::getInstance()->uploadObj($report);
                header('Location: /Agora/Post/visit/' . $idPost);
            }else{
                header('Location: /Agora/User/home');
            }
        }  
    }
}