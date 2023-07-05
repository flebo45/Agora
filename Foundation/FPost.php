<?php

class FPost extends FDataBase{

    private static $table_name = "post";

    private static $table_field = "id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }



    public static function createPostInDb(Post $post, User $user)
    {
        $id = $post->getId();

        $db = FDataBase::getInstance();

        if($id == null) $db->createRawInRelation($post, $user);

    }

    public static function deletePostInDb(Post $post){

        $id = $post->getId();
        
        $db = FDataBase::getInstance();

        $result = $db->deleteObjInDb(self::getTable(), self::getField(), $id);

        return $result;
    }

    public static function postList(User $user){

        $id = $user->getId();
        $field = "cretor_id";

        $db = FDataBase::getInstance();

        $result = $db->objectList(self::getTable(), $field, $id);

        return $result;

    }
}