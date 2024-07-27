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
        $post->setUser($user);
        $lastId = FPersistentManager::getInstance()->uploadObj($post);
        $post->setId($lastId);
        
        //file check for the images uploaded
        $check = UHTTPMethods::files('imageFile','size',0);                                       
        //var_dump($check);
        if($check > 0){
            $uploadedImages = UHTTPMethods::files('imageFile');
            $check = FPersistentManager::getInstance()->manageImages($uploadedImages, $post, $userId);
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
    $post = FPersistentManager::getInstance()->loadPostInVisited($idPost);
    if(!is_array($post)){
        $view = new VManagePost();
        $visitedUserAndPic = FPersistentManager::getInstance()->loadUsersAndImage($post->getUser()->getId());

        $commentsAndUserPic = FPersistentManager::getInstance()->loadCommentsAndUsersPic($idPost);

        //array with: like number, follower number, followed number
        $numericInfo = FPersistentManager::getInstance()->loadFollLikeNumb($post);

        if(!CUser::isLogged()){
            $userAndPropic = null;
            $like = false;
            $follow = false;
        }else{
            USession::getInstance();
            $userId = USession::getSessionElement('user');

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
        $idUser = USession::getInstance()->getSessionElement('user');
        $usersAndPropic = FPersistentManager::getInstance()->getLikesPage($idPost);

        $view = new VManagePost();
        $view->showUsersList($usersAndPropic, $idUser, 'like');
    }
}

/**
 * this method is called when a User want to delete a Post 
 * @param int $idPost Refers to the id of a post 
 */
public static function delete($idPost)
{
    if(CUser::isLogged()){
        $idUser = USession::getInstance()->getSessionElement('user');

        $post = FPersistentManager::getInstance()->getPostAndUser($idPost);
    
        //check if the Post exist
        if(count($post) > 0  && $idUser == $post[0]->getUser()->getId()){
            FPersistentManager::getInstance()->deletePost($idPost, $idUser);
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

        $post = FPersistentManager::getInstance()->retriveObj(EPost::getEntity(), $idPost);
        if(count($post) > 0){
            //create new Like Obj and persist it
            $like = new ELike($idUser, $idPost);
            FPersistentManager::getInstance()->uploadObj($like);
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
        if(!is_array($like)){
            FPersistentManager::getInstance()->deleteLike($like->getId(), $idUser);
        }
        header('Location: /Agora/Post/visit/' . $idPost);
    }
}
}