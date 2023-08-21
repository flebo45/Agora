<?php

class UServer
{
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


    public static function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}