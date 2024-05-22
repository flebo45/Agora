<?php

class CPost{


    /**
    * show the page for the creation of a post
    */

    public static function postForm(){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);

            $view = new VManagePost();
            $view->showCreationForm($userAndPropic);
        }
    }

    /** 
    * create a post taking info from the form and check if the uploaded images are ok
    */
    public static function createPost(){
        if(CUser::isLogged()){
            $view = new VManagePost();

            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);

            //create new Post Obj and upload it in the db 
            $post = new EPost(UHTTPMethods::post('title'), UHTTPMethods::post('description'), UHTTPMethods::post('category')); 
            $user->addPost($post);
            FPersistentManager::uploadObj($user);
            //file check for the images uploaded
            $check = UHTTPMethods::files('imageFile','size',0);                                       
            //var_dump($check);
            if($check > 0){
                $uploadedImages = UHTTPMethods::files('imageFile');
                $check = FPersistentManager::getInstance()->manageImagesPost($uploadedImages, $post);
                if(!$check){
                    $view->uploadFileError($check);
                }
            }
            header('Location: /Agora/User/personalProfile');
        }
    }

    /**
    * show the page of a single post, with it's information and info about the creator
    * @param int $idPost Refers to the id of a post 
    */

    public static function visit($idPost){
        $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
        if($post !== null){
            $view = new VManagePost();
            $visitedUserAndPic = FPersistentManager::getInstance()->loadUsersAndImage($post->getUser()->getId());

            //$commentsAndUserPic = array();
            $commentsAndUserPic = FPersistentManager::getInstance()->loadCommentsAndUsersPic($post);

            //array with: like number, follower number, followed number
            $numericInfo = FPersistentManager::getInstance()->loadFollLikeNumb($post);

            if(!CUser::isLogged()){
                $userAndPropic = null;
                $like = null;
                $follow = false;
            }else{
                USession::getInstance();
                $userId = USession::getInstance()->getSessionElement('user');

                $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);
                $follow = FPersistentManager::getInstance()->retriveFollow($userId, $post->getUser()->getId());
                $like = FPersistentManager::getInstance()->retriveLike($userId, $idPost);
            }

            $view->showPost($userAndPropic, $visitedUserAndPic, $post, $commentsAndUserPic, $numericInfo, $like,  $follow);

        }else{
            header('Location: /Agora/User/home');
        }
    }

    /**
    * show the list of the Users who liked the Post
    * @param int $idPost Refers to the id of a post 
    */
    public static function like($idPost){
        if(CUser::isLogged()){
            $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
            if($post !== null){
                $usersAndPropic = FPersistentManager::getInstance()->getLikesPage($post);
                $view = new VManagePost();
                $view->showUsersList($usersAndPropic, 'like');
            }
        }
    }

    /**
    * this method is called when a User want to delete a Post 
    * @param int $idPost Refers to the id of a post 
    */
    public static function delete($idPost){
        if(CUser::isLogged()){
            $idUser = USession::getInstance()->getSessionElement('user');

            $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
    
            //check if the Post exist
            if($post !== null){
                if($idUser == $post->getUser()->getId()){
                    FPersistentManager::getInstance()->deleteObj($post);
                }
            }
            header('Location: /Agora/User/personalProfile');
        }
    }

    /**
    * this method is called when the User want to like the Post that is visualizing 
    * @param int $idPost Refers to the id of a post 
    */
    public static function settingLike($idPost){
        if(CUser::isLogged()){
            $idUser = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $idUser);

            $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
            if($post !== null){
                //create new Like Obj and persist it
                $like = new ELike($user);
                $post->addLike($like);
                FPersistentManager::getInstance()->uploadObj($post);
            }
            header('Location: /Agora/Post/visit/' . $idPost);
        }
    }

    /**
    * this method is called when the User want to delete teh like of the Post that is visualizing 
    * @param int $idPost Refers to the id of a post 
    */
    public static function deleteLike($idPost){
        if(CUser::isLogged()){
            $idUser = USession::getInstance()->getSessionElement('user');
            
            $like = FPersistentManager::getInstance()->retriveLike($idUser, $idPost);

            //check if the like exist and the User who is deleting the like is the same User
            if($like !== null){
                FPersistentManager::getInstance()->deleteObj($like);
            }
            header('Location: /Agora/Post/visit/' . $idPost);
        }
    } 
}