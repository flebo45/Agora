<?php

class FModerator{
    public static function getModByUsername($username){
        $result = FEntityManager::getInstance()->retriveObjNotOnId(EModerator::getEntity(), 'username', $username);

        return $result;
    }
}