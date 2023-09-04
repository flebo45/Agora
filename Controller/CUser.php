<?php

class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged()
    {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
            self::isBanned();
        }
        return $logged;
    }

    /**
     * check if the user is banned
     * @return void
     */
    public static function isBanned()
    {
        $pm = FPersistentManager::getInstance();
        $userId = USession::getSessionElement('user');
        $user = $pm::retriveObj(EUser::getEntity(), $userId);
        if($user->isBanned()){
            $view = new VUser();
            USession::unsetSession();
            USession::destroySession();
            $view->loginBan();
        }
    }

    public static function registration()
    {
        if(UServer::getRequestMethod() == "POST"){
            self::checkRegistration();
        }
        else{
            header('Location: /Agora/User/login');
        }
    }

    public static function checkRegistration()
    {
        $pm = FPersistentManager::getInstance();
        $email = $pm::verifyEmail($_POST['email']);
        $view = new VUser();
        if($email == false){
            $username = $pm::verifyUsername($_POST['username']);
            if($username == false){
                $user = new EUser($_POST['name'], $_POST['surname'],$_POST['age'], $_POST['email'],$_POST['password'],$_POST['username']);
                $pm::uploadObj($user);
                if($pm::retriveObj(EImage::getEntity(), 1) != null){
                    $user->setIdImage(1);
                    $pm::uploadObj($user);
                }else{
                    $image = new EImage('default', 0, "image/png", "default");
                    $pm::uploadObj($image);
                    $user->setIdImage(1);
                    $pm::uploadObj($user);
                }
                header('Location: /Agora/User/login');
            }
            else{
                $view->registrationError("username");
            }
        }
        else{
            $view->registrationError("email");
        }
    }

    public static function login()
    {
        if(UServer::getRequestMethod() == "GET"){
            if(self::isLogged()){
                header('Location: /Agora/User/home');
            }else{
                $view = new VUser();
                $view->showLoginForm();
            }
           }
           elseif(UServer::getRequestMethod() == "POST"){
            self::checkLogin();
           }
    }

    public static function checkLogin()
    {
        if(UServer::getRequestMethod() != 'GET'){
            $pm = FPersistentManager::getInstance();
            $view = new VUser();
            $username = $pm::verifyUsername($_POST['username']);
            if($username){
                $user = $pm::retriveUserOnUsername($_POST['username']);
                if(password_verify($_POST['password'], $user->getPassword())){
                    if($user->isBanned()){
                        $view->loginBan();
                    }
                    else{
                        if(USession::getSessionStatus() == PHP_SESSION_NONE){
                            USession::getInstance();
                            USession::setSessionElement('user', $user->getId());
                            //set color for text and background
                            //USession::setSessionElement('colorLabel', 'black');
                            //USession::setSessionElement('backgroundLabel', 'red');
                            header('Location: /Agora/User/home');
                        }
                    }
                }
                else{
                    $view->loginError();
                }
                
            }else{
                $view->loginError();
            }
        }
    }

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Agora/User/login');
    }

    public static function home()
    {
        if(UServer::getRequestMethod() == "GET"){
            if(CUser::isLogged())
        {
            $pm = FPersistentManager::getInstance();
            $view = new VUser();

            $userId = USession::getSessionElement('user');
            $user = $pm::retriveObj(EUser::getEntity(), $userId);
            $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

            $postInHome = $pm::loadHomePage($user->getId());
            
            $vipUsers = $pm::loadVip();
            $vipPic = array();
            

            foreach($vipUsers as $v)
            {
                $vipPic[$v->getId()] = $pm::retriveObj(EImage::getEntity(), $v->getIdImage());
            }

            if(count($postInHome) === 0)
            {
                $view->home($user, $proPic, null,  $vipUsers, $vipPic);
            }else{
                $view->home($user, $proPic, $postInHome, $vipUsers, $vipPic);
            }
        }else{
            header('Location: /Agora/User/login');
        }
        }
        
    }

    public static function personalProfile()
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            { 
                $view = new VUser();
                USession::getInstance();
                $pm = FPersistentManager::getInstance();
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveObj(EUser::getEntity(), $userId);
                $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());
                

                $postProfile = $pm::loadUserPage($user->getId());

                if(count($postProfile) === 0)
                {
                    $view->uploadPersonalUserInfo($user, $proPic, null, null);
                }else{
                    $arrayLikeNumb = array();
                    foreach($postProfile as $p)
                    {
                        $arrayLikeNumb[$p->getId()] = $pm::getLikeNumber($p->getId());
                    }
                    $view->uploadPersonalUserInfo($user,$proPic, $postProfile, $arrayLikeNumb);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function profile($username)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            {
                USession::getInstance();
                $pm = FPersistentManager::getInstance();

                $personalUserId =  USession::getSessionElement('user');
                $personalUser = $pm::retriveObj(EUser::getEntity(), $personalUserId);
                if($personalUser->getUsername() != $username)
                {
                    if($pm::verifyUsername($username))
                    {
                        $personalProPic = $pm::retriveObj(EImage::getEntity(), $personalUser->getIdImage());
                        $user = $pm::retriveUserOnUsername($username);
                        $profileProPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                        $postUser = $pm::loadUserPage($user->getId());
                        $follow = $pm::retriveFollow($personalUserId, $user->getId());
                        $view = new VUser();

                        if($follow !== null)
                        {
                            $followCheck = true;
                        }else{
                            $followCheck = false;
                        }
                        if(count($postUser) === 0)
                        {
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, null, null, $followCheck);
                        }else{
                            $arrayLikeNumb = array();
                            foreach($postUser as $p)
                            {
                                $arrayLikeNumb[$p->getId()] = $pm::getLikeNumber($p->getId());
                            }
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, $postUser, $arrayLikeNumb, $followCheck);
                        }
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

    public static function settings($param)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if($param == 0)
            {
                $view = new VUser();
                $pm = FPersistentManager::getInstance();
                USession::getInstance();

                $userId = USession::getSessionElement('user');
                $user = $pm::retriveObj(EUser::getEntity(), $userId);
                $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());
                $view->settings($user, $proPic);
            }else{
                header('Location: /Agora/User/home');
            }
        }elseif(UServer::getRequestMethod() == 'POST')
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $view = new VUser();
                
            $userId = USession::getSessionElement('user');
            $user = $pm::retriveObj(EUser::getEntity(), $userId);
            //credential form (bio, hobby ecc)
            if($param == 1)
            {
                $user->setBio($_POST['Bio']);
                $user->setWorking($_POST['Working']);
                $user->setStudiedAt($_POST['StudiedAt']);
                $user->setHobby($_POST['Hobby']);
                $pm::uploadObj($user);
                header('Location: /Agora/User/personalProfile');
            //Username
            }elseif($param == 2)
            {
                if($user->getUsername() == $_POST['username']){
                    header('Location: /Agora/User/personalProfile');
                }else{
                    if($pm::verifyUsername($_POST['username']) == false)
                    {
                        $user->setUsername($_POST['username']);
                        $pm::uploadObj($user);
                        header('Location: /Agora/User/personalProfile');
                    }else{
                        $view->usernameError($user);
                    }
                }
            //password
            }elseif($param == 3)
            {
                $newPass = $_POST['password'];
                $user->setPassword($newPass);
                $pm::uploadObj($user);
                header('Location: /Agora/User/personalProfile');
            //proPic
            }elseif($param == 4)
            {
                if($_FILES['imageFile']['size'] > 0)
                {
                    $uploadedImage = $_FILES['imageFile'];
                    $checkUploadImage = self::uploadImage($uploadedImage);
                    if($checkUploadImage == 'UPLOAD_ERROR_OK'){
                        $view->uploadFileError('UPLOAD_ERROR_OK');
                    }
                    elseif($checkUploadImage == 'TYPE_ERROR'){
                        $view->uploadFileError('TYPE_ERROR');
                    }
                    elseif($checkUploadImage == 'SIZE_ERROR'){
                        $view->uploadFileError('SIZE_ERROR');
                    }
                    else{
                        $pm::uploadObj($checkUploadImage);
                        $user->setIdImage($checkUploadImage->getId());
                        $pm::uploadObj($user);
                        header('Location: /Agora/User/personalProfile');
                    }
                }else{
                    header('Location: /Agora/User/settings/0');
                }
            }else{
                header('Location: /Agora/User/settings/0');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function uploadImage($file){
        $check = CPost::validateImage($file);
        if($check[0]){
            $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
            return $image;
        }else{
            return $check[1];
        }
    }

    public static function category($category)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                $view = new VUser();
                USession::getInstance();
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveObj(EUser::getEntity(), $userId);
                $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                $postCategory = $pm::loadPostPerCategory($category);

                if(count($postCategory) > 0)
                {
                    $view->category($user, $proPic, $postCategory);
                }else{
                    $view->category($user, $proPic, null);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function explore()
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                $view = new VUser();
                USession::getInstance();
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveObj(EUser::getEntity(), $userId);
                $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                $postExplore = $pm::loadPostInExplore($user->getId());

                if(count($postExplore) > 0)
                {
                    $view->explore($user, $proPic, $postExplore);
                }else{
                    $view->explore($user, $proPic, null);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function followers($idUser)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                $userList = $pm::getFollowedList($idUser);
                $usersPic = array();
                foreach($userList as $u)
                {
                    $pic = $pm::retriveObj(EImage::getEntity(), $u->getIdImage());
                    $usersPic[$u->getId()] = $pic;
                }
                $view = new VManagePost();
                $view->showUsersList($userList, $usersPic, 'followers');

            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function followed($idUser)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();
                $userList = $pm::getFollowerList($idUser);
                $usersPic = array();
                foreach($userList as $u)
                {
                    $pic = $pm::retriveObj(EImage::getEntity(), $u->getIdImage());
                    $usersPic[$u->getId()] = $pic;
                }
                $view = new VManagePost();
                $view->showUsersList($userList, $usersPic, 'followed');

            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function follow($followedId)
    {
        if(UServer::getRequestMethod() == "POST")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();

                USession::getInstance();
                $userId = USession::getSessionElement('user');

                $follow = new EUserFollow($userId, $followedId);
                $pm::uploadObj($follow);
                $visitedUser = $pm::retriveObj(EUser::getEntity(), $followedId);
                header('Location: /Agora/User/profile/' . $visitedUser->getUsername());
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    public static function unfollow($followedId)
    {
        if(UServer::getRequestMethod() == "POST")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();

                USession::getInstance();
                $userId = USession::getSessionElement('user');

                $follow = $pm::retriveFollow($userId, $followedId);
                $pm::deleteFollow($follow);
                $visitedUser = $pm::retriveObj(EUser::getEntity(), $followedId);
                header('Location: /Agora/User/profile/' . $visitedUser->getUsername());
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }
}