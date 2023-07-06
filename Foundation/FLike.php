<?php

class FLike extends FEntityManager{

    private $table_name = "elike";

    private $table_field = "id";

    private $entity_class = ELike::class;

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

    public static function saveLikeInDb(ELike $like, Post $post, User $user){
        $fem = FEntityManager::getInstance();

        $objects = [$like, $post, $user];

        $fem->saveObjects($objects);
    }

    public static function deleteLikeInDb(ELike $like){
        $id = $like->getId();
        
        $fem = FEntityManager::getInstance();

        $result = $fem->deleteObjInDb(self::getEntityClass(), $id);

        return $result;
    }

    public static function likeList(Post $post){
        $id = $post->getId();
        $field = "post_id";

        $fem = FEntityManager::getInstance();

        $result = $fem->objectList(self::getTable(), $field, $id);

        return $result;
    }
}