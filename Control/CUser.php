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
        $user =  USession::getSessionElement('user');
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
                $image = new EImage('default', 0, "image/png", "default");
                $pm::uploadObj($image);
                $user->setIdImage($image);
                $pm::uploadObj($user);
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
                            USession::setSessionElement('user', $user);
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
        $cookie_params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $cookie_params['path'], $cookie_params['domain'], $cookie_params['secure'], $cookie_params['httponly']);
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

            $user = USession::getSessionElement('user');
            $proPic = $pm::retriveProPicInfo($user->getIdImage());

            $postInHome = $pm::loadHomePage($user->getId());

            $vipUsers = $pm::loadVip();
            $vipPic = array();

            foreach($vipUsers as $v)
            {
                $vipPic[$v->getId()] = $pm::retriveProPicInfo($v->getId());
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
                $pm = FPersistentManager::getInstance();
                USession::getInstance();
                $user = USession::getSessionElement('user');
                $proPic = $pm::retriveProPicInfo($user->getIdImage());

                $postProfile = $pm::loadUserPage($user->getId());

                if(count($postProfile) === 0)
                {
                    $view->uploadPersonalUserInfo($user, $proPic, null);
                }else{
                    $view->uploadPersonalUserInfo($user,$proPic, $postProfile);
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

                $personalUser =  USession::getSessionElement('user');
                if($personalUser->getUsername() != $username)
                {
                    if($pm::verifyUsername($username))
                    {
                        $personalProPic = $pm::retriveProPicInfo($personalUser->getIdImage());
                        $user = $pm::retriveUserOnUsername($username);
                        $profileProPic = $pm::retriveProPicInfo($user->getIdImage());

                        $postUser = $pm::loadUserPage($user->getId());
                        $view = new VUser();

                        if(count($postUser) === 0)
                        {
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, null);
                        }else{
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, $postUser);
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

                $user = USession::getSessionElement('user');
                $proPic = $pm::retriveProPicInfo($user->getIdImage());
                $view->settings($user, $proPic);
            }else{
                header('Location: /Agora/User/home');
            }
        }elseif(UServer::getRequestMethod() == 'POST')
        {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $view = new VUser();
                
            $user = USession::getSessionElement('user');
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
                        $oldProPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());
                        $pm::deleteImage($oldProPic);
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
        $check = CManagePost::validateImage($file);
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
                $user = USession::getSessionElement('user');
                $proPic = $pm::retriveProPicInfo($user->getIdImage());

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
                $user = USession::getSessionElement('user');
                $proPic = $pm::retriveProPicInfo($user->getIdImage());

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
}