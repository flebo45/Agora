<?php

class FPerson{

    public static function verify($field, $id){
        $result = FEntityManager::getInstance()->verifyAttributes('User', EPerson::getEntity(), $field, $id);

        return $result;
    }

}