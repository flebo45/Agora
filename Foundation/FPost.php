<?php

class FPost{

    private $table_name = "post";

    # methods

    public static function getTable(){

        return self::$table_name;
    }




    public static function loadPostInDb($field, $id){

        $db = FDataBase::getInstance();

        //perform a query via Fdatabase That check if the post already exist
        $db->existInDb(self::getTable(), $field, $id);

        //if exist = true Perform query via Fdatabase to Update the table

        //else perform a query via Fdatabse to create post in the table

    }
}