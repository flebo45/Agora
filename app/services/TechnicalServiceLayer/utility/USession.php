<?php
require_once(__DIR__ . '/../../../config/config.php');
/**
 * class to access to the $_SESSION superglobal array, you Must use this class instead of using directly the array
 */
class USession{

    /**
     * singleton class
     * class for the session, if you want to manipulate the _SESSION superglobal ypu need to use this class
     */

     private static $instance;

     private function __construct() {
        session_set_cookie_params(COOKIE_EXP_TIME); //set the duration of the session cookie
        session_start(); //start the session
     }
 
     public static function getInstance() {
         if (self::$instance == null) {
             self::$instance = new USession();
         }
 
         return self::$instance;
     }

    /**
     * return session status. If you want to check if the session is staretd you can use this
     */
    public static function getSessionStatus(){
        return session_status();
    }

    /**
     * unset all the elements in the _SESSION superglobal
     */
    public static function unsetSession(){
        session_unset();
    }

    /**
     * unset of an element of _SESSION superglobal
     */
    public static function unsetSessionElement($id){
        unset($_SESSION[$id]);
    }

    /**
     * destroy the session
     */
    public static function destroySession(){
        session_destroy();
    }

    /**
     * get element in the _SESSION superglobal
     */
    public static function getSessionElement($id){
        return $_SESSION[$id];
    }

    /**
     * set an element in _SESSION superglobal
     */
    public static function setSessionElement($id, $value){
        $_SESSION[$id] = $value;
    }

    /**
     * check if an element is set or not
     * @return boolean
     */
    public static function isSetSessionElement($id){
        if(isset($_SESSION[$id])){
            return true;
        }else{
            return false;
        }
    }
}