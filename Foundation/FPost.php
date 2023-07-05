<?php

class FPost{

    private $table_name = "post";

    private $table_field = "post_id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }



    public static function loadPostInDb(Post $post)
    {
        $id = $post->getId();

        $db = FDataBase::getInstance();

        //perform a query via Fdatabase That check if the post already exist
        $query_result = $db->existInDb(self::getTable(),self::getField(), $id);

        //if exist = true Perform query via Fdatabase to Update the table
        if($query_result) $db->updateRaw($post);

        //else perform a query via Fdatabse to create post in the table
        else {$db->createRaw($post);}
    }

    public static function deletePostInDb(Post $post){

        $id = $post->getId();
        
        $db = FDataBase::getInstance();

        $result = $db->deleteObjInDb(self::getTable(), self::getField(), $id);

        return $result;
    }
}