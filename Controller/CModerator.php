<?php

class CModerator{

    /**
     * check if the Moderator is logged (using session)
     * @return boolean
     */
    public static function isLogged()
    {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('mod')){
            $logged = true;
        }
        return $logged;
    }

    
    /**
     * check the request, if the Mod have the session cookie(isLogged()) return the Mod in the home page, if not and request is in POST 
     * start the checkLogin() to start the login process
     * @return void
     */
    public static function login()
    {
        if(UServer::getRequestMethod() == "GET"){
            if(self::isLogged()){
                header('Location: /Agora/Moderator/reportList');
            }else{
                $view = new VModerator();
                $view->showLoginForm();
            }
           }
           elseif(UServer::getRequestMethod() == "POST"){
            self::checkLogin();
           }
    }

    
    /**
     * check if exist teh Username inserted, and for this username check the password. If is everything correct the session is created and
     * the Mod is redirected in the homepage
     */
    public static function checkLogin()
    {
        if(UServer::getRequestMethod() != 'GET'){
            $pm = FPersistentManager::getInstance();
            $view = new VModerator();
            $username = $pm::verifyUserUsername($_POST['username']);
            if($username){
                $user = $pm::retriveModOnUsername($_POST['username']);
                if(password_verify($_POST['password'], $user->getPassword())){
                    if(USession::getSessionStatus() == PHP_SESSION_NONE){
                        USession::getInstance();
                        USession::setSessionElement('mod', $user->getId());
                        header('Location: /Agora/Moderator/reportList');
                        }
                    } else{
                    $view->loginError();
                }
               
            }else{
                $view->loginError();   
            }
        }
    }

    
    /**
     * this method can logout the User, unsetting all the session element and destroing the session. Return the user to the Login Page
     * @return void
     */
    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Agora/Moderator/login');
    }

    public static function reportList()
    {
        if(UServer::getRequestMethod() == 'GET')
        {
            if(CModerator::isLogged())
            {
                $pm = FPersistentManager::getInstance();

                USession::getInstance();
                $modId = USession::getSessionElement('mod');

                $mod = $pm::retriveObj(EModerator::getEntity(), $modId);

                $reportedPost = $pm::getReportedPost();
                $reportedComment = $pm::getReportedComment();

                /*$postUserPic = array();
                $commentUserPic = array();

                if(count($reportedPost) > 0)
                {
                    foreach($reportedPost as $rp)
                    {
                        $postUserPic[$rp->getPost()->getId()] = $pm::retriveObj(EImage::getEntity(), $rp->getPost()->getUser()->getIdImage());
                    }
                }
                if(count($reportedComment) > 0)
                {
                    foreach($reportedComment as $rc)
                    {
                        $commentUserPic[$rc->getComment()->getId()] = $pm::retriveObj(EImage::getEntity(), $rc->getComment()->getUser()->getIdImage());
                    }
                }*/

                $view = new VModerator();

                $view->showReportList($mod->getUsername(), $reportedPost,  $reportedComment);
            }else{
                header('Location: /Agora/Moderator/login');
            }
        }else{
            header('Location: /Agora/Moderator/reportList');
        }
    }


}