<?php

class FPerson extends FEntityManager{

    public static function verify($field, $id){
        $fem = FEntityManager::getInstance();
        $result = $fem::verifyAttributes('User', EPerson::getEntity(), $field, $id);

        return $result;
    }

}