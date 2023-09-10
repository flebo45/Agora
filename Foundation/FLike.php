<?php

class FLike extends FEntityManager{

    public static function deleteLikeInDb(ELike $like){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($like);

        return $result;
    }

    public static function getLikeNumber($idPost)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::countObjectListAttribute(ELike::getEntity(), 'idPost', $idPost);

        return $result;
    }

    public static function getLikeList($idPost)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectList(ELike::getEntity(), 'idPost', $idPost);

        return $result;
    }

    public static function getLike($idUser, $idPost)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::getObjOnAttributes(ELike::getEntity(), 'idUser', $idUser, 'idPost', $idPost);

        return $result;
    }

}