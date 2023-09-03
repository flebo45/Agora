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

}