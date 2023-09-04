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

                $postUserPic = array();
                $userPic = array();

                if(count($searchedPosts) > 0)
                {
                    foreach($searchedPosts as $s)
                    {
                        $postUserPic[$s->getId()] = $pm::retriveObj(EImage::getEntity(), $s->getUser()->getIdImage());
                    }
                }
                if(count($searchedUsers) > 0)
                {
                    foreach($searchedUsers as $u)
                    {
                        $userPic[$u->getId()] = $pm::retriveObj(EImage::getEntity(), $u->getIdImage());
                    }
                }

                $view = new VSearch();
                $view->showSearch($_POST['keyword'], $searchedPosts, $postUserPic, $searchedUsers, $userPic);
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }
}