<?php
//singleton class
class FDataBase{

    private static $instance;

    private function __construct(){
        //PDO conn to db
    }

    public function getIstance(){
        if(self::$instance == null){
            self::$instance = new FPersistentManager();
        }

        return self::$instance;
    }

}

?>