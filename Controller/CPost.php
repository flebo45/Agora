<?php

//TODO immagini in create post

class CPost{

private static $allowedType = ['image/jpeg', 'image/png', 'image/jpg'];
private static $maxSize = 5242880; //5MB

public static function getAllowedType(){
    return self::$allowedType;
}

public static function getMaxSize(){
    return self::$maxSize;
}

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
            $post = new EPost($_POST['title'], $_POST['description'], $_POST['category']);
            $post->setUser($user);
            $pm::uploadObj($post);
            $check = $_FILES['imageFile']['size'][0];
            var_dump($check);
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


public static function uploadImage($file, $post){
    $check = self::validateImage($file);
    if($check[0]){
        $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
        $post->addImage($image);
        return $image;
    }else{
        return $check[1];
    }
}

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

                $view = new VManagePost();
                
                $view->showPost($user, $userPic, $visitedUserPic, $post, $comments, $numbLike);
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
            $comment = new EComment($_POST['body'], $user, $idPost);
            $pm::uploadObj($comment);
            $userPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());
            $post = $pm::retriveObj(EPost::getEntity(), $idPost);
            $visitedUserPic = $pm::retriveObj(EImage::getEntity(), $post->getUser()->getIdImage());
            $numbLike = $pm::getLikeNumber($idPost);

            
            $comments = $pm::getCommentList($post->getId());
            $view = new VManagePost();
                
            $view->showPost($user, $userPic, $visitedUserPic, $post, $comments, $numbLike);
        }
    }
}

public static function report($idPost){
    if(UServer::getRequestMethod() == 'POST')
    {
        if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $idUser = USession::getSessionElement('user');
            $report = new EReport($_POST['description'], $_POST['type'], $idUser);
            $pm::uploadObj($report);
            $reportedPost = $pm::retriveObj(EPost::getEntity(), $idPost);
            $report->setPost($reportedPost);
            $pm::uploadObj($report);
            header('Location: /Agora/User/home');
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}

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
                $usersPic[$u->getId()] = $pic;
            }
            $view = new VManagePost();
            $view->showLikesList($usersLikeList, $usersPic);
        }else{
            header('Location: /Agora/User/login');
        }
    }else{
        header('Location: /Agora/User/home');
    }
}


}