<?php

class CPost{

private static $allowedType = ['image/jpeg', 'image/png', 'image/jpg'];
private static $maxSize = 5242880; //5MB

public static function getAllowedType(){
    return self::$allowedType;
}

public static function getMaxSize(){
    return self::$maxSize;
}

/**
 * check the request: if GET show the page for the creation of a post;
 * if POST start the process to create a new post 
 */
public static function createPost(){
    if(UServer::getRequestMethod() == "GET")
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $userId = USession::getSessionElement('user');
            $user = $pm::retriveObj(EUser::getEntity(), $userId);
            $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

            $view = new VManagePost();
            $view->showCreationForm($user, $proPic);
        }else{
            header('Location: /Agora/User/login');
        }
    }elseif(UServer::getRequestMethod() == "POST")
    {
        if(CUser::isLogged())
        {
            $view = new VManagePost();
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $userId = USession::getSessionElement('user');
            $user = $pm::retriveObj(EUser::getEntity(), $userId);

            //create new Post Obj and upload it in the db 
            $post = new EPost($_POST['title'], $_POST['description'], $_POST['category']);
            $post->setUser($user);
            $pm::uploadObj($post);

            //file check for the images uploaded
            $check = $_FILES['imageFile']['size'][0];
            //var_dump($check);
            if($check > 0){
                $uploadedImages = $_FILES['imageFile'];
                foreach($uploadedImages['tmp_name'] as $index => $tmpName){
                    $file = [
                        'name' => $uploadedImages['name'][$index],
                        'type' => $uploadedImages['type'][$index],
                        'size' => $uploadedImages['size'][$index],
                        'tmp_name' => $tmpName,
                        'error' => $uploadedImages['error'][$index]
                    ];
                    
                    //check if the uploaded image is ok 
                    $checkUploadImage = self::uploadImage($file, $post);
                    if($checkUploadImage == 'UPLOAD_ERROR_OK'){
                        $pm::deletePost($post);
                        $view->uploadFileError('UPLOAD_ERROR_OK');
                    }
                    elseif($checkUploadImage == 'TYPE_ERROR'){
                        $pm::deletePost($post);
                        $view->uploadFileError('TYPE_ERROR');
                    }
                    elseif($checkUploadImage == 'SIZE_ERROR'){
                        $pm::deletePost($post);
                        $view->uploadFileError('SIZE_ERROR');
                    }
                    else{
                        $pm::uploadImagePost($checkUploadImage, $post);
                        header('Location: /Agora/User/personalProfile');
                    } 
                }
            }else{
                header('Location: /Agora/User/personalProfile');
            }
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

/**
 * check if the uploaded image is ok and then create an Image Obj and save it in the database
 */
public static function uploadImage($file, $post){
    $check = self::validateImage($file);
    if($check[0]){
        
        //create new Image Obj ad perist it
        $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
        $post->addImage($image);
        return $image;
    }else{
        return $check[1];
    }
}

/**
 * check if the image is ok and in case return the error
 */
public static function validateImage($file){
    if($file['error'] !== UPLOAD_ERR_OK){
        $error = 'UPLOAD_ERROR_OK';

        return [false, $error];
    }

    if(!in_array($file['type'], self::getAllowedType())){
        $error = 'TYPE_ERROR';

        return [false, $error];
    }

    if($file['size'] > self::getMaxSize()){
        $error = 'SIZE_ERROR';

        return [false, $error];
    }

    return [true, null];
}

/**
 * show the page of a single post, with it's information and info about the creator
 * if Get show the post
 * if Post create a new Comment related to the Post 
 */
public static function visit($idPost)
{
    if(UServer::getRequestMethod() == 'GET')
    {
        if(CUser::isLogged())
        {
            
            $pm = FPersistentManager::getInstance();
            $post = $pm::retriveObj(EPost::getEntity(), $idPost);
            if($post !== NULL)
            {
                USession::getInstance();
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveObj(EUser::getEntity(), $userId);
                $userPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                $visitedUserPic = $pm::retriveObj(EImage::getEntity(), $post->getUser()->getIdImage());

                $comments = $pm::getCommentList($post->getId());

                $numbLike = $pm::getLikeNumber($idPost);

                $followerNumb = $pm::getFollowerNumb($post->getUser()->getId());
                $followedNumb = $pm::getFollowedNumb($post->getUser()->getId());

                $like = $pm::retriveLike($userId, $idPost);
                if($like !== null)
                {
                    $checkLike = true;
                }else{
                    $checkLike = false;
                }
                $view = new VManagePost();
                
                $view->showPost($user, $userPic, $visitedUserPic, $post, $comments, $numbLike, $followedNumb, $followerNumb, $checkLike);
            }else{
                header('Location: /Agora/User/home');
            }
        }
    }elseif(UServer::getRequestMethod() == 'POST')
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $userId = USession::getSessionElement('user');
            $user = $pm::retriveObj(EUser::getEntity(), $userId);

            //create new Comment and upload it 
            $comment = new EComment($_POST['body'], $user, $idPost);
            $pm::uploadObj($comment);

            $userPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

            $post = $pm::retriveObj(EPost::getEntity(), $idPost);

            $visitedUserPic = $pm::retriveObj(EImage::getEntity(), $post->getUser()->getIdImage());

            $numbLike = $pm::getLikeNumber($idPost);

            $followerNumb = $pm::getFollowerNumb($post->getUser()->getId());
            $followedNumb = $pm::getFollowedNumb($post->getUser()->getId());

            
            $comments = $pm::getCommentList($post->getId());
            $like = $pm::retriveLike($userId, $idPost);
                if($like !== null)
                {
                    $checkLike = true;
                }else{
                    $checkLike = false;
                }
            $view = new VManagePost();
                
            $view->showPost($user, $userPic, $visitedUserPic, $post, $comments, $numbLike, $followedNumb, $followerNumb,  $checkLike);
        }
    }
}

/**
 * this method is called when a user report a Post 
 */
public static function report($idPost){
    if(UServer::getRequestMethod() == 'POST')
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $idUser = USession::getSessionElement('user');

            $reportedPost = $pm::retriveObj(EPost::getEntity(), $idPost);
            if($reportedPost !== null)
            {
                //create a new Report Obj and persist it
                $report = new EReport($_POST['description'], $_POST['type'], $idUser);
                $pm::uploadObj($report);
                $report->setPost($reportedPost);
                $pm::uploadObj($report);
            }
            header('Location: /Agora/User/home');
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

/**
 * show the list of the Users who liked the Post
 */
public static function like($idPost)
{
    if(UServer::getRequestMethod() == 'GET')
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            $usersLikeList = $pm::getLikesUserOfAPost($idPost);
            
            $usersPic = array();
            foreach($usersLikeList as $u)
            {
                $pic = $pm::retriveObj(EImage::getEntity(), $u->getIdImage());
                //associative array, save the Users pic 
                $usersPic[$u->getId()] = $pic;
            }

            $view = new VManagePost();
            $view->showUsersList($usersLikeList, $usersPic, 'like');
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

/**
 * this method is called when a User want to delete a Post 
 */
public static function delete($idPost)
{
    if(UServer::getRequestMethod() == 'GET')
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $idUser = USession::getSessionElement('user');

            $post = $pm::retriveObj(EPost::getEntity(), $idPost);

            //check if the Post exist
            if($post !== null)
            {
                //check if the Logged User is the owner of the Post
                if($idUser == $post->getUser()->getId() && $post !== null)
                {
                    $pm::deletePost($post);

                    header('Location: /Agora/User/personalProfile');
                }else{
                    header('Location: /Agora/User/home');
                }
            }else{
                header('Location: /Agora/User/personalProfile');
            }

            
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

/**
 * this method is called when the User want to like the Post that is visualizing 
 */
public static function settingLike($idPost)
{
    if(UServer::getRequestMethod() == "POST")
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $idUser = USession::getSessionElement('user');

            $post = $pm::retriveObj(EPost::getEntity(), $idPost);

            if($post !== null)
            {
                //create new Like Obj and persist it
                $like = new ELike($idUser, $idPost);
                $pm::uploadObj($like);
            }
            header('Location: /Agora/Post/visit/'.$idPost);
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

/**
 * this method is called when the User want to delete teh like of the Post that is visualizing 
 */
public static function deleteLike($idPost)
{
    if(UServer::getRequestMethod() == "POST")
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $idUser = USession::getSessionElement('user');

            $like = $pm::retriveLike($idUser, $idPost);

            //check if the like exist and the User who is deleting the like is the same User
            if($like !== null && $like->getIdUser == $idUser)
            {
                $pm::deleteLike($like);
            }
            header('Location: /Agora/Post/visit/'.$idPost);
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

}