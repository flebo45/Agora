<?php

class CSearch{

    public static function search()
    {
        if(UServer::getRequestMethod() == 'POST')
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                $searchedPosts = $pm::getSerachedPosts($_POST['keyword']);
                $searchedUsers = $pm::getSearchedUsers($_POST['keyword']);

                

            }
        }
    }
}