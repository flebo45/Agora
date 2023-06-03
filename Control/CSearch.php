<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\Agora\Control\CUser.php');


class CSearch{

    public function sendSearch($keyword){
        if(CUser::isLogged()){
            $pm = FPersistentManager::getInstance();
            $itemList = $pm->search($keyword);

            //call to a view

        }

        else{
            //header
        }
    }

    public function selectItem(){
        if(CUser::isLogged()){
            //take data from the view
            //controllo sull'id per vedere se è post o commento
            $pm = FPersistentManager::getInstance();
            //se post
            $pm->selectPost($postID);
            //show view of post

            //se utente 
            $pm->selectUser($userID);
            //show view of user
        }
        else{
            //header
        }
    }

}