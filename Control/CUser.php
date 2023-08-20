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

    public static function home(){
        if(CUser::isLogged()){
            $pm = FPersistentManager::getInstance();
            //$view = new VUser();
            
        }

    }
}