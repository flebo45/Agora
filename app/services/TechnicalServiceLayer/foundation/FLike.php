<?php

class FLike{

    private static $table = "likes";

    private static $value = "(NULL,:idUser,:idPost)";

    private static $key = "idLike";

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

    public static function createLikeObj($queryResult){
        if(count($queryResult) == 1){
            $like = new ELike($queryResult[0]['idUser'], $queryResult[0]['idPost']);
            $like->setId($queryResult[0]['idLike']);
            return $like;
        }elseif(count($queryResult) > 1){
            $likes = array();
            for($i = 0; $i < count($queryResult); $i++){
                $l = new ELike($queryResult[$i]['idUser'], $queryResult[$i]['idPost']);
                $l->setId($queryResult[$i]['idLike']);
                $likes[] = $l;
            return $likes;
            }
        }else{
            return array();
        }  
    }

    public static function bind($stmt, $like){
        $stmt->bindValue(":idUser", $like->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":idPost", $like->getIdPost(), PDO::PARAM_INT);
    }

    public static function getObj($id){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if(count($result) > 0){
            $like = self::createLikeObj($result);
            return $like;
        }else{
            return null;
        }
    }

    public static function saveObj($obj){
        $saveLike = FEntityManagerSQL::getInstance()->saveObject(self::getClass(), $obj);
        if($saveLike !== null){
            return true;
        }else{
            return false;
        }
    }

    public static function getLikeNumber($idPost)
    {
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), FPost::getKey(), $idPost);
    
        return count($result);
    }

    public static function getLikeOnUser($idUser, $idPost){
        $queryResult = FEntityManagerSQL::getInstance()->getObjOnAttributes(self::getTable(), Fuser::getKey(), $idUser, FPost::getKey(), $idPost);
        $like = self::createLikeObj($queryResult);

        return $like;
        
    }

    public static function deleteLikeInDb($idLike, $idUser){
        try{
            FEntityManagerSQL::getInstance()->getDb()->beginTransaction();
            $queryResult = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $idLike);
            if(FEntityManagerSQL::getInstance()->existInDb($queryResult) && FEntityManagerSQL::getInstance()->checkCreator($queryResult, $idUser)){
                FEntityManagerSQL::getInstance()->deleteObjInDb(self::getTable(), self::getKey(), $idLike);
                FEntityManagerSQL::getInstance()->getDb()->commit();
                return true;
            }else{
                FEntityManagerSQL::getInstance()->getDb()->commit();
                return false;
            }
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            FEntityManagerSQL::getInstance()->getDb()->rollBack();
            return false;
        }finally{
            FEntityManagerSQL::getInstance()->closeConnection();
        }
    }
}