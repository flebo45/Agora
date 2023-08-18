<?php

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
        //user element is for set the session
        if(USession::isSetSessionElement('user')){
            $logged = true;
            //check if banned
        }
        return $logged;

    }



}
