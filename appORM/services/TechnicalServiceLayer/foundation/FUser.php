<?php

class FUser{
    public static function getUserByUsername($username){
        $result = FEntityManager::getInstance()->retriveObjNotOnId(EUser::getEntity(), 'username', $username);

        return $result;
    }

    public static function loadVipUsers(){
        $result = FEntityManager::getInstance()->objectList(EUser::getEntity(), 'vip', '1');

        return $result;
    }

    public static function getSearched($keyword){
        $result = FEntityManager::getInstance()->getSearchedItem(EUser::getEntity(), "username", $keyword);
        return $result;
    }
}