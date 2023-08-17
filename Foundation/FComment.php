<?php

class FComment extends FEntityManager{

    private static $entity_class = Comment::class;

    # methods

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function retriveComment($id){
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj(self::getEntityClass(), $id);

        return $result;
    }

    public static function saveCommentInDb(Comment $comment, Post $post, User $user){
        $fem = FEntityManager::getInstance();

        $objects = [$comment, $post, $user];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    

    public static function deleteCommentInDb(Comment $obj){
  
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($obj);

        return $result;
    }

    public static function commentList(Post $post){

        $fem = FEntityManager::getInstance();

        $id = $post->getID();

        $field = "post";

        $result = $fem::objectList(self::getEntityClass(), $field, $id);

        return $result;
    }

    public static function commentListNotBanned(Post $post){
        
        $fem = FEntityManager::getInstance();

        $id = $post->getID();

        $field = "post";

        $result = $fem::objectListNotRemoved(self::getEntityClass(), $field, $id);

        return $result;
    }
}