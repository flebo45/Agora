<?php

class FPost extends FEntityManager{

    private static $entity_class = Post::class;

    # methods

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function retrivePost($id){
        $fem = FEntityManager::getInstance();
        $result = $fem::retriveObj(self::getEntityClass(), $id);
        return $result;
    }

    public static function savePostInDb(Post $post, User $user)
    {
        $fem = FEntityManager::getInstance();

        $objects = [$post, $user];

        $result = $fem::saveObjects($objects);

        return $result;

    }

    public static function deletePostInDb(Post $post){
        
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($post);

        return $result;
    }

    public static function postList(User $user){

        $fem = FEntityManager::getInstance();

        $id = $user->getId();

        $field = "user";

        $result = $fem::objectList(self::getEntityClass(), $field, $id);

        return $result;
    }

    public static function postListNotBanned(User $user){

        $fem = FEntityManager::getInstance();

        $id = $user->getId();

        $field = "user";

        $result = $fem::objectListNotRemoved(self::getEntityClass(), $field, $id);

        return $result;
    }
}