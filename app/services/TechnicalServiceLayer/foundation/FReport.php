<?php

class FReport{

    private static $table = "report";

    private static $value = "(NULL,:description,:type,:idUser,:idPost,:idComment)";

    private static $key = "idReport";

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

    public static function createReportObj($queryResult){
        if(count($queryResult) > 0){
            $reports = array();
            for($i = 0; $i < count($queryResult); $i++){
                $report = new EReport($queryResult[$i]['description'], $queryResult[$i]['type'], $queryResult[$i]['idUser']);
                $report->setId($queryResult[$i]['idReport']);
                if($queryResult[$i]['idPost'] !== null){
                    $postRow = FEntityManagerSQL::getInstance()->retriveObj(FPost::getTable(), FPost::getKey(), $queryResult[$i]['idPost']);
                    $post = FPost::getPostWithUser($postRow);
                    $report->setPost($post[0]);
                }else{
                    $comment = FComment::getObj($queryResult[$i]['idComment']);
                    $report->setComment($comment);
                }
                $reports[] = $report;
            }
            return $reports;
        }else{
            return array();
        }
    }

    public static function bind($stmt, $report){
        $stmt->bindValue(":description", $report->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $report->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":idUser", $report->getIdUser(), PDO::PARAM_INT);
        if($report->getPost() !== null){
            $stmt->bindValue(":idPost", $report->getPost()->getId(), PDO::PARAM_INT);
        }else{
            $stmt->bindValue(":idPost", null, PDO::PARAM_NULL);
        }
        if($report->getComment() !== null){
            $stmt->bindValue(":idComment", $report->getComment()->getId(), PDO::PARAM_INT);
        }else{
            $stmt->bindValue(":idComment", null, PDO::PARAM_NULL);
        }
    }

    public static function getObj($id){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        //var_dump($result);
        if(count($result) > 0){
            $report = self::createReportObj($result);
            return $report;
        }else{
            return null;
        }
    }

    public static function saveObj($obj){
        $saveReport = FEntityManagerSQL::getInstance()->saveObject(self::getClass(), $obj);
        if($saveReport !== null){
            return true;
        }else{
            return false;
        }
    }

    public static function reportedPostList(){
        $result = FEntityManagerSQL::getInstance()->objectListOnNull(self::getTable(), 'idComment');

        return $result;
    }

    public static function reportedCommentList(){
        $result = FEntityManagerSQL::getInstance()->objectListOnNull(self::getTable(), 'idPost');

        return $result;
    }

    public static function deleteReportInDb($id, $field = null){
        try{
            FEntityManagerSQL::getInstance()->getDb()->beginTransaction();
            if($field === null){
                FEntityManagerSQL::getInstance()->deleteObjInDb(self::getTable(), self::getKey(), $id);
            }else{
                FEntityManagerSQL::getInstance()->deleteObjInDb(self::getTable(), $field, $id);
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