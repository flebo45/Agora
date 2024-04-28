<?php

class FComment{

    private static $table = "comment";

    private static $value = "(NULL,:body,:creation_time,:removed,:idPost,:idUser)";

    private static $key = "idComment";

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

    public static function crateCommentObj($queryResult){
        if(count($queryResult) == 1){
            $author = FUser::getOBj($queryResult[0]['idUser']);
            $comment = new EComment($queryResult[0]['body'], $author, $queryResult[0]['idPost']);
            $comment->setId($queryResult[0]['idComment']);
            $dateTime =  DateTime::createFromFormat('Y-m-d H:i:s', $queryResult[0]['creation_time']);
            $comment->setCreationTime($dateTime);
            $comment->setBan($queryResult[0]['removed']);
            return $comment;
        }elseif(count($queryResult) > 1){
            $comments = array();
            for($i = 0; $i < count($queryResult); $i++){
                $author = FUser::getOBj($queryResult[$i]['idUser']);
                $comment = new EComment($queryResult[$i]['body'], $author, $queryResult[$i]['idPost']);
                $comment->setId($queryResult[$i]['idComment']);
                $dateTime =  DateTime::createFromFormat('Y-m-d H:i:s', $queryResult[$i]['creation_time']);
                $comment->setCreationTime($dateTime);
                $comment->setBan($queryResult[$i]['removed']);
                $comments[] = $comment;
            }
            return $comments;
        }else{
            return array();
        }
    }

    public static function bind($stmt, $comment){
        $stmt->bindValue(":body", $comment->getBody(), PDO::PARAM_STR);
        $stmt->bindValue(":creation_time", $comment->getTimeStr(), PDO::PARAM_STR);
        $stmt->bindValue(":removed", $comment->isBanned(), PDO::PARAM_BOOL);
        $stmt->bindValue(":idPost", $comment->getIdPost(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $comment->getUser()->getId(), PDO::PARAM_STR);
    }

    public static function getObj($id){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        //var_dump($result);
        if(count($result) > 0){
            $comment = self::crateCommentObj($result);
            return $comment;
        }else{
            return null;
        }

    }

    public static function saveObj($obj, $fieldArray = null){

        if($fieldArray === null){
            $saveComment = FEntityManagerSQL::getInstance()->saveObject(self::getClass(), $obj);
            if($saveComment !== null){
                return true;
            }else{
                return false;
            }
        }else{
            try{
                FEntityManagerSQL::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv){
                    FEntityManagerSQL::getInstance()->updateObj(FComment::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());
                }
                FEntityManagerSQL::getInstance()->getDb()->commit();
                return true;

            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                FEntityManagerSQL::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManagerSQL::getInstance()->closeConnection();
            }
        }
        
    }


    public static function getCommentListNotBanned($idPost)
    {

        $result = FEntityManagerSQL::getInstance()->objectListNotRemoved(self::getTable(), FPost::getKey(), $idPost);

        if(count($result) == 1){
            $comment = array();
            $c = self::crateCommentObj($result);
            $comment[] = $c;
            return $comment;
        }elseif(count($result) > 1){
            return self::crateCommentObj($result);
        }else{
            return $result;
        }
        
    }
}