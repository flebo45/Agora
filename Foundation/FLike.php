<?php

class FLike extends FDataBase{

    private $table_name = "elike";

    private $table_field = "id";

     # methods

     public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function createLikeInDB(ELike $like){
        $id = $like->getId();
        $db = FDataBase::getInstance();

        //perform a query via Fdatabase That check if the post already exist
        $query_result = $db->existInDb(self::getTable(),self::getField(), $id);

        //if exist = true Perform query via Fdatabase to Update the table
        if($query_result) return true;

        //else perform a query via Fdatabse to create post in the table
        else {$db->createRaw($like);}
    }

    public static function likeList(Post $post){
        $id = $post->getId();
        $field = "post_id";

        $db = FDataBase::getInstance();
        $result = $db->objectList(self::getTable(), $field, $id);

        return $result;
    }

}