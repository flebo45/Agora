<?php

class FImage extends FEntityManager{

    private static $entity_class = Image::class;

    #methods

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function retriveImage($id){

        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj(self::getEntityClass(), $id);

        return $result;
    }

    public static function saveImagePostIndb(Image $image, Post $post){

        $fem = FEntityManager::getInstance();

        $objects = [$image, $post];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function savePicUSerinDb(Image $image, User $user){

        $fem = FEntityManager::getInstance();

        $objects = [$image, $user];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function deleteImageInDb(Image $image){
        
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($image);

        return $result;
    }

    public static function imageList(Post $post){
        
        $fem = FEntityManager::getInstance();

        $id = $post->getID();

        $field = "post";

        $result = $fem::objectList(self::getEntityClass(), $field, $id);

        return $result;
    }
}