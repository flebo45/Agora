<?php

class FImage extends FEntityManager{

    public static function saveImagePostIndb(EImage $image, EPost $post){

        $fem = FEntityManager::getInstance();

        $objects = [$image, $post];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function deleteImageInDb(EImage $image){
        
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($image);

        return $result;
    }

}