<?php

class FPost extends FEntityManager{

    private static $table_name = "post";

    private static $table_field = "id";

    private static $entity_class = Post::class;

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function getEntityClass(){

        return self::$entity_class;
    }



    public static function savePostInDb(Post $post, User $user)
    {
        $fem = FEntityManager::getInstance();

        $objects = [$post, $user];

        $result = $fem->saveObjects($objects);

        return $result;

    }

    public static function deletePostInDb(Post $post){

        $id = $post->getId();
        
        $fem = FEntityManager::getInstance();

        $result = $fem->deleteObjInDb(self::getEntityClass(), $id);

        return $result;
    }

    public static function postList(User $user){

        $id = $user->getId();
        echo $id;
        $field = "creator_id";

        $fem = FEntityManager::getInstance();

        $result = $fem->objectList(self::getTable(), $field, $id);

        return $result;

    }
}