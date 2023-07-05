<?php

class FUser extends FDataBase{

    private $table_name = "user";

    private $table_field = "id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function createUserInDb(User $user){
        $id = $user->getId();

        $db = FDataBase::getInstance();

        if($id == null){
            $db->createRaw($user);
        }else{
            //perform a query via Fdatabase That check if the post already exist
            $query_result = $db->existInDb(self::getTable(),self::getField(), $id);
            
            //if exist = true Perform query via Fdatabase to Update the table
            if($query_result) $db->updateRaw($user);
        }
    }
}