<?php
//TODO login, sign, change attributes, logout, profile, home, follow, 
class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged(){
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
            self::isBanned();
        }
        return $logged;
    }


    /**
     * check if the user is banned
     * @return void
     */
    public static function isBanned(){
        $userId = USession::getSessionElement('user');
        $pm = FPersistentManager::getInstance();
            
        $user = $pm::retriveUser($userId);
        //$view = new VUser();

        if($user->isBanned()){
            USession::unsetSession();
            USession::destroySession();
            //$view->banPage();
        }
        
    }

    /**
     * show the home page of the user
     * if logged show all the posts of the followed user in time order desc
     */
    public static function home(){
        if(CUser::isLogged()){
            $pm = FPersistentManager::getInstance();
            //$view = new VUser();

            $userId = USession::getSessionElement('user');
            $user = $pm::retriveUser($userId);
            $postsInHome = $pm::loadHomePage($user);
            if($postsInHome == null){
                //view della pagina vuota
            }else{
                usort($postsInHome, ['CManagePost', 'comparePostsBycreationTime']);
                //now $postInHome is modified
            }
            //pass attributes of the post to the view to show it in the homepage 
        }

    }
}