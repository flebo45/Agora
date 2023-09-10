<?php

/**
 * class to acces to the $_SERVER superglobal array, you Must use this array instead of using directly the _SERVER array
 */
class UServer
{
    /**
     * singleton class
     */
    private static $instance=null;

    static function getInstance(){

        if (UServer::$instance == null){
            if (isset($_SERVER['single'])) {
                UServer::$instance = $_SERVER['single'];
            }
            else {
                UServer::$instance = new UServer();
                $_SERVER['single'] = UServer::$instance;
            }
        }
        return UServer::$instance;
    }

    /**
     * return the request method of the server(POT, GET, ...)
     */
    public static function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}