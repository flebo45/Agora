<?php

class CSearch{

    /**
     * load all the Posts and the Users who have in their Title/Username the $kewyword 
     */
    public static function search(){
        if(CUser::isLogged()){
            //list of Posts 'title LIKE keyword'
            $searchedPosts = FPersistentManager::getInstance()->getSearchedPost(UHTTPMethods::post('keyword'));             
            //list of Users 'username LIKE keyword'
            $searchedUsers = FPersistentManager::getInstance()->getSearchedUsers(UHTTPMethods::post('keyword'));

            $view = new VSearch();
            $view->showSearch(UHTTPMethods::post('keyword'), $searchedPosts, $searchedUsers);
        }
    }
}