<?php

class FUserFollow extends FEntityManager{

    public static function followedNumb($idUser)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::countObjectListAttribute(EUserFollow::getEntity(), 'idFollower', $idUser);

        return $result;
    }

    public static function followerNumb($idUser)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::countObjectListAttribute(EUserFollow::getEntity(), 'idFollowed', $idUser);

        return $result;
    }

    public static function followedList($idUser)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectList(EUserFollow::getEntity(), 'idFollower', $idUser);

        return $result;
    }

    public static function followerList($idUser)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectList(EUserFollow::getEntity(), 'idFollowed', $idUser);

        return $result;
    }

    public static function getFollow($idUser, $followedId)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::getObjOnAttributes(EUserFollow::getEntity(), 'idFollower', $idUser, 'idFollowed', $followedId);

        return $result;
    }
}