<?php

class FComment extends FEntityManager{

    public static function getCommentListNotBanned($idPost)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectListNotRemoved(EComment::getEntity(), 'idPost', $idPost);

        return $result;
    }
}