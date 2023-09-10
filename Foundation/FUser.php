<?php

class FUser extends FEntityManager{

    public static function getUserByUsername($username)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObjNotOnId(EUser::getEntity(), 'username', $username);

        return $result;
    }

    public static function getFollowed($id)
    {
        $fem = FEntityManager::getInstance();

        $followed = $fem::objectListAttribute(EUserFollow::getEntity(), 'idFollower', $id);

        return $followed;
    }

    public static function loadVipUsers()
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectListAttribute(EUser::getEntity(), 'vip', '1');

        return $result;
    }

    public static function topUserFollower()
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::topUserFollower();

        return $result;
    }

    public static function getSearched($keyword)
    {
        $fem =  FEntityManager::getInstance();

        $result = $fem::getSearchedItem(EUser::getEntity(), 'username', $keyword);

        return $result;
    }

}