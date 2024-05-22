<?php

class FLike{
    public static function getLikeOnUser($idUser, $idPost){
        $result = FEntityManager::getInstance()->getObjOnTwoAttributes(ELike::getEntity(), 'user', $idUser, 'post', $idPost);

        return $result;
    }
}