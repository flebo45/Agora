<?php

class CComment{

    /**
     * create a comment taking info from the compiled form and associate it to the post
     * @param int $idPost Refers to id of the post
     */
    public static function createComment($idPost){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(FUser::getClass(), $userId);

            $comment = new EComment(UHTTPMethods::post('body'), $user, $idPost);
            FPersistentManager::getInstance()->uploadObj($comment);
            header("Location: /Agora/Post/visit/" . $idPost);
        }
    }
}