<?php

class FImage{

    private static $table = "image";

    private static $value = "(NULL,:name,:size,:types,:imageData,:idPost)";

    private static $key = "idImage";

    public static function getTable(){
        return self::$table;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getClass(){
        return self::class;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function createImageObj($queryResult){
        if(count($queryResult) > 0){
            $images = array();
            for($i = 0; $i < count($queryResult); $i++){
                $im = new EImage($queryResult[$i]['name'], $queryResult[$i]['size'],$queryResult[$i]['types'],$queryResult[$i]['imageData']);
                $im->setId($queryResult[$i]['idImage']);
                $images[] = $im;
            }
            return $images;
        }else{
            return array();
        }
    }

    public static function bind($stmt, $image){
        $stmt->bindValue(":name", $image->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":size", $image->getSize(), PDO::PARAM_INT);
        $stmt->bindValue(":types",$image->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":imageData", $image->getImageData(), PDO::PARAM_LOB);
        if($image->getPost() !== null){
            $stmt->bindValue(":idPost", $image->getPost()->getId(), PDO::PARAM_INT);
        }else{
            $stmt->bindValue(":idPost", null, PDO::PARAM_NULL);
        }
        
    }

    public static function getObj($id){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        //var_dump($result);
        if(count($result) > 0){
            $image = self::createImageObj($result);
            if(count($image) == 1){
                return $image[0];
            }
            return $image;
        }else{
            return null;
        }
    }

    public static function saveObj($obj){

        $saveImage = FEntityManagerSQL::getInstance()->saveObject(self::getClass(), $obj);
        if($saveImage !== null){
            return $saveImage;
        }else{
            return false;
        }
    }

    public static function getObjOnPostId($idPost){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), FPost::getKey(), $idPost);

        if(count($result) > 0){
            $image = self::createImageObj($result);
            return $image;
        }else{
            return null;
        }
    }
}