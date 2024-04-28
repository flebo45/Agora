<?php

class FPost{

    private static $table = "post";

    private static $value = "(NULL,:title,:description,:category,:creation_time,:removed,:idUser)";

    private static $key = "idPost";

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
    
    /**
     * Proxy obj
     */
    public static function createPostObj($queryResult){
        if(count($queryResult) > 0){
            $posts = array();
            for($i = 0; $i < count($queryResult); $i++){
                $p = new EPost($queryResult[$i]['title'],$queryResult[$i]['description'],$queryResult[$i]['category']);
                $p->setId($queryResult[$i]['idPost']);
                $dateTime =  DateTime::createFromFormat('Y-m-d H:i:s', $queryResult[$i]['creation_time']);
                $p->setCreationTime($dateTime);
                $p->setBan($queryResult[$i]['removed']);
                $posts[] = $p;
            }
            return $posts;
        }else{
            return array();
        }
    }

    public static function bind($stmt, $post){
        $stmt->bindValue(":title", $post->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(":description", $post->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":category", $post->getCategory(), PDO::PARAM_STR);
        $stmt->bindValue("creation_time", $post->getTimeStr(), PDO::PARAM_STR);
        $stmt->bindValue(":removed", $post->isBanned(), PDO::PARAM_BOOL);
        $stmt->bindValue(":idUser", $post->getUser()->getId(), PDO::PARAM_INT);
    }

    public static function getObj($id){
        $result = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        //var_dump($result);
        if(count($result) > 0){
            $post = self::createPostObj($result);
            return $post;
        }else{
            return null;
        }
    }

    public static function saveObj($obj , $fieldArray = null){
        if($fieldArray === null){
            $savePost = FEntityManagerSQL::getInstance()->saveObject(self::getClass(), $obj);
            if($savePost !== null){
                return $savePost;
            }else{
                return false;
            }
        }else{
            try{
                FEntityManagerSQL::getInstance()->getDb()->beginTransaction();
                //var_dump($fieldArray);
                foreach($fieldArray as $fv){
                    FEntityManagerSQL::getInstance()->updateObj(FPost::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());
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

    /**
     * un post ha immagini, commenti, likes; verificare che chi sta eliminando è il creatore del post
     */
    public static function deletePostInDb($idPost, $idUser){        
        try{
            FEntityManagerSQL::getInstance()->getDb()->beginTransaction();
            $queryResult = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $idPost);

            if(FEntityManagerSQL::getInstance()->existInDb($queryResult) && FEntityManagerSQL::getInstance()->checkCreator($queryResult, $idUser)){
                //mi servono solo gli id della query
                $likesList = FEntityManagerSQL::getInstance()->retriveObj(FLike::getTable(), self::getKey(), $idPost);
                for($i = 0; $i < count($likesList); $i++){
                    FEntityManagerSQL::getInstance()->deleteObjInDb(FLike::getTable(), FLike::getKey(), $likesList[$i][FLike::getKey()]);
                }

                $commentsList = FEntityManagerSQL::getInstance()->retriveObj(FComment::getTable(), self::getKey(), $idPost);
                for($i = 0; $i < count($commentsList); $i++){
                    $reportCommList = FEntityManagerSQL::getInstance()->retriveObj(FReport::getTable(), FComment::getKey(), $commentsList[$i][FComment::getKey()]);
                    for($j = 0; $j < count($reportCommList); $j++){
                        FEntityManagerSQL::getInstance()->deleteObjInDb(FReport::getTable(), FReport::getKey(), $reportCommList[$j][FReport::getKey()]);
                    }
                    FEntityManagerSQL::getInstance()->deleteObjInDb(FComment::getTable(), FComment::getKey(), $commentsList[$i][FComment::getKey()]);
                }

                $imagesList = FEntityManagerSQL::getInstance()->retriveObj(FImage::getTable(), self::getKey(), $idPost);
                for($i = 0; $i < count($imagesList); $i++){
                    FEntityManagerSQL::getInstance()->deleteObjInDb(FImage::getTable(), FImage::getKey(), $imagesList[$i][FImage::getKey()]);
                }

                $reportList = FEntityManagerSQL::getInstance()->retriveObj(FReport::getTable(), self::getKey(), $idPost);
                for($i = 0; $i < count($reportList); $i++){
                    FEntityManagerSQL::getInstance()->deleteObjInDb(FReport::getTable(), FReport::getKey(), $reportList[$i][FReport::getKey()]);
                }

                FEntityManagerSQL::getInstance()->deleteObjInDb(self::getTable(), self::getKey(), $idPost);

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

    public static function getSearched($field, $keyword){
        //chiedere la row di post
        //creare i post 
        //settare gli utenti
        //ritornare la lista di post
        $queryResult = FEntityManagerSQL::getInstance()->getSearchedItem(self::getTable(), $field, $keyword);
        foreach($queryResult as $key =>$row){
            if($row['removed'] == true){
                unset($queryResult[$key]);
            }
        }
        if($field == 'title'){
            $posts = self::getPostWithUser($queryResult);
        }else{
            $posts = self::getPostComplete($queryResult);
        }
        
        return $posts;
    }

    public static function postListNotBanned($idUser){
        //ritorna una lista di post non bannati di un utente
        $queryResult = FEntityManagerSQL::getInstance()->objectListNotRemoved(self::getTable(), FPerson::getKey(), $idUser);
        $posts = self::getPostComplete($queryResult);
        return $posts;
    }

    public static function getPostWithUser($queryResult){
        $posts = array();
        if(count($queryResult) > 0){
            $posts =  self::createPostObj($queryResult);
            for($i = 0; $i < count($queryResult); $i++){
                $idUser = $queryResult[$i][FUser::getKey()];
                $user = FUser::getObj($idUser);
                $posts[$i]->setUser($user);
            }
        }
        return $posts;
    }

    public static function getPostComplete($queryResult){
        $posts = array();
        if(count($queryResult) > 0){
            $posts =  self::createPostObj($queryResult);
            for($i = 0; $i < count($queryResult); $i++){
                $idUser = $queryResult[$i][FUser::getKey()];
                $user = FUser::getObj($idUser);
                $posts[$i]->setUser($user);
                //var_dump($posts[$i]);

                $images = FImage::getObjOnPostId($posts[$i]->getId());
                //var_dump($images);
                if($images !== null){
                    foreach($images as $im){
                        $posts[$i]->addImage($im);
                    }
                }
            }
        }
        return $posts;
    }

    public static function postInExplore($idUser){
        try{
            $query = "SELECT p.* FROM " . FPost::getTable() . " p WHERE p." . FUser::getKey() . " <> :idUser AND p.removed = false ORDER BY p.creation_time DESC LIMIT :limit";
            $stmt = FEntityManagerSQL::getInstance()->getDb()->prepare($query);
            $stmt->bindValue(':idUser', $idUser);
            $stmt->bindValue(':limit', MAX_POST_EXPLORE, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) == 0) {   
                return array();
            }else{
                $posts = self::getPostComplete($result);
                return $posts;
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    public static function postInVisited($idPost){
        $queryResult = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), self::getKey(), $idPost);

        $postArr = self::getPostComplete($queryResult);
        return $postArr[0]; 
    }

    public static function comparePostsByCreationTime($post1, $post2) {
        $time1 = $post1->getTime();
        $time2 = $post2->getTime();

        if ($time1 == $time2) {
            return 0;
        }

        return ($time1 > $time2) ? -1 : 1;
    }

}
