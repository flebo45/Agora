<?php

class CComment{

    /**
     * create a comment taking info from the compiled form and associate it to the post
     * @param int $idPost Refers to id of the post
     */
    public static function createComment($idPost){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);

            $comment = new EComment(UHTTPMethods::post('body'), $user);
            $post->addComment($comment);
            FPersistentManager::getInstance()->uploadObj($post);
            header("Location: /Agora/Post/visit/" . $idPost);
        }
    }
}