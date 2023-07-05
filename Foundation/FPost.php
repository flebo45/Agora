<?php

class FPost{

    private $table_name = "post";

    private $table_field = "post_id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }




    public static function loadPostInDb($field, $id){

        $db = FDataBase::getInstance();

        //perform a query via Fdatabase That check if the post already exist
        $query_result = $db->existInDb(self::getTable(), $field, $id);

        //if exist = true Perform query via Fdatabase to Update the table
        if($query_result) $db->updateRaw();

        //else perform a query via Fdatabse to create post in the table
        else {$db->createRaw();}
    }
}