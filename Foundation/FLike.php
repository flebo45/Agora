<?php

class FLike extends FEntityManager{

    public static function deleteLikeInDb(ELike $like){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($like);

        return $result;
    }

}