<?php

class FUser extends FEntityManager{

    private static $entity_class = User::class;

    # methods
    public static function getEntityClass(){

        return self::$entity_class;
    }

    /**
     * retrive the User object from the database
     * @return obj || null
     */
    public static function retriveUser($id){
        $fem = FEntityManager::getInstance();
        $result = $fem::retriveObj(self::getEntityClass(), $id);
        return $result;
    }

    /**
     * this work both for creation and update (In update you need to retrive the user)
     * @return boolean
     */
    public static function  saveUserInDb(User $user){
        $fem = FEntityManager::getInstance();
        $result = $fem::saveObject($user);
        return $result;
    }



}