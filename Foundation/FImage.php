<?php

class FImage extends FEntityManager{

    private $table_name  = "image";

    private $table_field = "id";

    private $entity_class = Image::class;

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function saveUserPic(Image $image, User $user){
        $fem = FEntityManager::getInstance();

        $objects = [$image, $user];

        $result = $fem->saveObjects($objects);

        return $result;
    }

    public static function savePostPics(array $images, Post $post){
        $fem = FEntityManager::getInstance();

        $objects = [$post];
        foreach($images as $img){
            $objects[] = $img;
        }
        $result = $fem->saveObjects($objects);
    
        return $result;
    }
}