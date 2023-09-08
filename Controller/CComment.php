<?php

class CComment{

    /**
     * method to report a comment
     */
    public static function report($id)
    {
        if(UServer::getRequestMethod() == 'POST')
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                USession::getInstance();
                $idUser = USession::getSessionElement('user');

                $reportedComment = $pm::retriveObj(EComment::getEntity(), $id);
            if($reportedComment !== null)
            {
                //create a new Report Obj and persist it
                $report = new EReport('', 'linguaggio scurrile', $idUser);
                $pm::uploadObj($report);
                $report->setComment($reportedComment);
                $pm::uploadObj($report);
            }
            header('Location: /Agora/User/home');
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }
}