<?php

class FModerator extends FEntityManager{

    public static function getModByUsername($username)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObjNotOnId(EModerator::getEntity(), 'username', $username);

        return $result;
    }

}