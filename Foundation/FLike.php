<?php

class FLike extends FEntityManager{

    private static $entity_class = ELike::class;

    #methods

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function retriveLike($id){
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj(self::getEntityClass(), $id);

        return $result;
    }

    public static function saveLikeInDb(ELike $like, Post $post, User $user){
        $fem = FEntityManager::getInstance();

        $objects = [$like, $post, $user];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function deleteLikeInDb(ELike $like){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($like);

        return $result;
    }

    public static function likeList(Post $post){
        
        $fem = FEntityManager::getInstance();

        $id = $post->getID();

        $field = "post";

        $result = $fem::objectList(self::getEntityClass(), $field, $id);

        return $result;
    }
}