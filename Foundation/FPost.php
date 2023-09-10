<?php

class FPost extends FEntityManager{

    public static function deletePostInDb(EPost $post){

        $idPost = $post->getId(); 
        
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($post);

        if($result == true){
            $likes = $fem::objectList(ELike::getEntity(), 'idPost', $idPost);
            if(count($likes) > 0){
                foreach($likes as $l){
                    $fem::deleteObjInDb($l);
                }
            }
        }
    }

    public static function postListNotBanned($id){

        $fem = FEntityManager::getInstance();

        $field = "user";

        $result = $fem::objectListNotRemoved(EPost::getEntity(), $field, $id);

        return $result;
    }

    public static function comparePostsByCreationTime($post1, $post2) {
        $time1 = $post1->getTime();
        $time2 = $post2->getTime();

        if ($time1 == $time2) {
            return 0;
        }

        return ($time1 > $time2) ? -1 : 1;
    }

    public static function postListCategory($category){
        $fem =  FEntityManager::getInstance();

        $field = "category";

        $result = $fem::objectListAttribute(EPost::getEntity(), $field, $category);

        return $result;
    }

    public static function postInExplore($idUser)
    {
        $fem =  FEntityManager::getInstance();

        $result = $fem::getPostNotBelongedToUser(EPost::getEntity(), 'user', $idUser);

        return $result;
    }

    public static function getSearched($keyword)
    {
        $fem =  FEntityManager::getInstance();

        $result = $fem::getSearchedItemPart(EPost::getEntity(), 'title', $keyword);

        return $result;
    }

}