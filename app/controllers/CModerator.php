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
        if(!$logged){
            header("Location: /Agora/Moderator/login");
            exit;
        }
        return true;
    }

    public static function login(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('mod')){
            header('Location: /Agora/Moderator/reportList');
        }
        $view = new VModerator();
        $view->showLoginForm();
    }
    
    /**
     * check if exist the Username inserted, and for this username check the password. If is everything correct the session is created and
     * the Mod is redirected in the homepage
     */
    public static function checkLogin()
    {
        $view = new VModerator();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));
        if($username){
            $user = FPersistentManager::getInstance()->retriveModOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())){
                if(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('mod', $user->getId());
                    header('Location: /Agora/Moderator/reportList');
                    }
                }else{
                    $view->loginError();
                }
            }else{
                $view->loginError();
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

    /**
     * Show the all reported post and comment 
     */
    public static function reportList(){  
        if(CModerator::isLogged()){
            $modId = USession::getInstance()->getSessionElement('mod');
            $mod = FPersistentManager::getInstance()->retriveObj(EModerator::getEntity(), $modId);

            $reportedPost = FPersistentManager::getInstance()->getReportedPost();
            $reportedComment = FPersistentManager::getInstance()->getReportedComment();

            $view = new VModerator();

            $view->showReportList($mod->getUsername(), $reportedPost,  $reportedComment);
        }
    }

    /**
     * with this method the Moderator can ban an User. The ban delete all the related reports to the banned object
     * @param int $idUser Refers to the id of the user to ban
     */

    public static function banUser($idUser){
        if(CModerator::isLogged()){
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $idUser);
            if($user !== null){
                $user->setBan(true);
                FPersistentManager::getInstance()->updateUserBan($user);
                header('Location: /Agora/Moderator/reportList');
            }
        }
    }

    /**
     * with this method the Moderator can ban a Post. The ban delete all the related reports to the banned object
     * @param int $idPost Refers to the post to ban
     * @param int $idUser Refrs to the user who chreate the post 
     */
    public static function banPost($idPost, $idUser){
        if(CModerator::isLogged()){
            $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
            if($post !== null){
                $post[0]->setBan(true);
                FPersistentManager::getInstance()->updatePostBan($post[0]);
                FPersistentManager::getInstance()->deleteRelatedReports($idPost, 'idPost');

                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $idUser);
                $user->setWarnings();
                FPersistentManager::getInstance()->updateUserWarnings($user);

                if($user->getWarnings() == MAX_WARNINGS){
                    $user->setBan(true);
                    FPersistentManager::getInstance()->updateUserBan($user);
                }
                header('Location: /Agora/Moderator/reportList');
            }
        }
    }

    /**
     * with this method the Moderator can ban a  Commment. The ban delete all the related reports to the banned object
     * @param int $idComment Refers to the comment to ban
     */
    public static function banComment($idComment){
        if(CModerator::isLogged()){
            $comment = FPersistentManager::getInstance()->retriveObj(EComment::getEntity(), $idComment);
            if($comment !== null){
                $comment->setBan(true);
                FPersistentManager::getInstance()->updateCommentBan($comment);
                FPersistentManager::getInstance()->deleteRelatedReports($idComment, 'idComment');
            }
            header('Location: /Agora/Moderator/reportList');
        }
    }

    /**
     * this function is for sending email: 
     * if $reason is "ban" the $obj will be an EUser obj; 
     * if $reason is "comment" the $obj will be an EComment obj;
     * if $reason is "post" the $obj will be EPost obj.
     */
    private static function sendBanEmail($obj, $reason)
    {
        $headers = "From: noreply@agora.com";
        if($reason == "ban")
        {
            $to = $obj->getEmail();
            $subject = "Banned from our platform Agorà";
            $message = "You (".$obj->getUsername().") are Banned permanently from our platform Agora, cause you are violating our guide lines such as : Violence, Gambling, Offensive Content, Suspicious Acctivities, Pornography.";
        }elseif($reason == "comment")
        {
            $to = $obj->getUser()->getEmail();
            $subject = "Your Comment has been removed";
            $message = "Your Comment (Comment Id: ".$obj->getId().", Comment Body: ".$obj->getBody()."Comment User: ".$obj->getUser()->getUsername().") is violating our guide lines. Your comment has been removed.";
        }elseif($reason == "post")
        {
            $to = $obj->getUser()->getEmail();
            $subject = "Your Post has been removed";
            $message = "Your Post (Post Id: ".$obj->getId().", Post Title: ".$obj->getTitle().", Post Description: ".$obj->getDescription().", Post User: ".$obj->getUser()->getUsername().") is violating our guide lines. Your Post has been removed.";
        }
        mail($to, $subject, $message, $headers);
    }

    /**
     * With this method the Moderator ignore the Report, so it will be delated
     * @param int $id Refres to id of the report to delete
     */
    public static function ignore($id){
        if(CModerator::isLogged()){
            $report = FPersistentManager::getInstance()->retriveObj(EReport::getEntity(), $id);
            if($report !== null){
                FPersistentManager::getInstance()->deleteRelatedReports($id);
            }
            header('Location: /Agora/Moderator/reportList');
        }
    }

    /**
     * this method show the user page in the Moderator view
     * @param int $id Refers to the id of the user to visit
     */
    public static function visitUser($id)
    {

        if(CModerator::isLogged()){
            $modId = USession::getInstance()->getSessionElement('mod');
            $mod = FPersistentManager::getInstance()->retriveObj(EModerator::getEntity(), $modId);
            $modUsername = $mod->getUsername();

            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $id);
            if(!is_array($user)){
                $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($id);

                $userPosts = FPersistentManager::getInstance()->loadUserPage($id);

                $followerNumb = FPersistentManager::getInstance()->getFollowerNumb($id);
                $followedNumb = FPersistentManager::getInstance()->getFollowedNumb($id);

                $view = new VModerator();
                $view->visitUser($userAndPropic, $userPosts, $followerNumb, $followedNumb, $modUsername);
            }else{
                header('Location: /Agora/Moderator/reportList');
            }  
        }      
    }

    /**
     * this method show the Post in the Moderator view
     * @param int $id Refers to the id of the post to visit
     */
    public static function visitPost($id)
    {
        if(CModerator::isLogged()){
            $modId = USession::getInstance()->getSessionElement('mod');
            $mod = FPersistentManager::getInstance()->retriveObj(EModerator::getEntity(), $modId);
            $modUsername = $mod->getUsername();

            $post = FPersistentManager::getInstance()->loadPostInVisited($id);
            if(!is_array($post)){
                $userAndProPic = FPersistentManager::getInstance()->loadUsersAndImage($post->getUser()->getId());

                $view = new VModerator();
                $view->visitPost($post, $userAndProPic, $modUsername);
            }else{
                header('Location: /Agora/Moderator/reportList');
            }
        }
    }
}