<?php

class FUser extends FEntityManager{

    private $table_name = "user";

    private $table_field = "id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function  saveUserInDb(User $user){
        $fem = FEntityManager::getInstance();
        $fem->saveObject($user);
    }

    
}