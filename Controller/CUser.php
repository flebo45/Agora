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

    /**
     * check the request, and call to checkRegistration() to start the registartion process
     * @return void
     */
    public static function registration()
    {
        if(UServer::getRequestMethod() == "POST"){
            self::checkRegistration();
        }
        else{
            header('Location: /Agora/User/login');
        }
    }

    /**
     * verify if the choosen username and email already exist, create the User Obj and set a default profile image 
     * @return void
     */
    public static function checkRegistration()
    {
        $pm = FPersistentManager::getInstance();
        $email = $pm::verifyUserEmail($_POST['email']);
        $view = new VUser();
        if($email == false){
            $username = $pm::verifyUserUsername($_POST['username']);
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
                $view->registrationError();
            }
        }
        else{
            $view->registrationError();
        }
    }

    /**
     * check the request, if the user have the session cookie(isLogged()) return the User in the home page, if not and request is in POST 
     * start the checkLogin() to start the login process
     * @return void
     */
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

    /**
     * check if exist teh Username inserted, and for this username check the password. If is everything correct the session is created and
     * the User is redirected in the homepage
     */
    public static function checkLogin()
    {
        if(UServer::getRequestMethod() != 'GET'){
            $pm = FPersistentManager::getInstance();
            $view = new VUser();
            $username = $pm::verifyUserUsername($_POST['username']);
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
                            header('Location: /Agora/User/home');
                        }
                    }
                }
                else{
                    $error = true;
                    $view->loginError($error);
                }
                
            }else{
                $error = true;
                $view->loginError($error);
            }
        }
    }

    /**
     * this method can logout the User, unsetting all the session element and destroing the session. Return the user to the Login Page
     * @return void
     */
    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Agora/User/login');
    }

    /**
     * load all the Posts in homepage (Posts of the Users that the logged User are following). Also are loaded Information about vip User and
     * about profile Images of all the involved User
     */
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
            
            //load the VIP Users and their profile Images
            $vipUsers = $pm::loadVip();
            $vipPic = array();
            $vipFollower = array();
            

            foreach($vipUsers as $v)
            {
                //associative array for the Vip's images
                $vipPic[$v->getId()] = $pm::retriveObj(EImage::getEntity(), $v->getIdImage());
                //associative array for Vip's followers number
                $vipFollower[$v->getId()] = $pm::getFollowerNumb($v->getId());
            }



            if(count($postInHome) === 0)
            {
                $view->home($user, $proPic, null,null, $vipUsers, $vipPic, $vipFollower);
            }else{
                $followedPic = array();
                foreach($postInHome as $p)
                {
                    //asscoiative array for the users profile pic 
                    $followedPic[$p->getUser()->getId()] = $pm::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage());
                }
                $view->home($user, $proPic, $postInHome,$followedPic, $vipUsers, $vipPic, $vipFollower);
            }
        }else{
            header('Location: /Agora/User/login');
        }
        }else{
            header('Location: /Agora/User/home');
        }
        
    }

    /**
     * load Posts belonged to the logged User and his Bio information
     */
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
                
                //load all the Posts belonged to a User that are not Banned
                $postProfile = $pm::loadUserPage($user->getId());

                //load the number of followed and following users
                $followerNumb = $pm::getFollowerNumb($userId);
                $followedNumb = $pm::getFollowedNumb($userId);

                if(count($postProfile) === 0)
                {
                    $view->uploadPersonalUserInfo($user, $proPic, null, null, $followerNumb, $followedNumb);
                }else{
                    $arrayLikeNumb = array();
                    foreach($postProfile as $p)
                    {
                        $arrayLikeNumb[$p->getId()] = $pm::getLikeNumber($p->getId());
                    }
                    $view->uploadPersonalUserInfo($user,$proPic, $postProfile, $arrayLikeNumb, $followerNumb, $followedNumb);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    /**
     * load post belonget to the visited User and his informations
     */
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
                    if($pm::verifyUserUsername($username))
                    {
                        $personalProPic = $pm::retriveObj(EImage::getEntity(), $personalUser->getIdImage());
                        $user = $pm::retriveUserOnUsername($username);
                        $profileProPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                        $postUser = $pm::loadUserPage($user->getId());
                        $follow = $pm::retriveFollow($personalUserId, $user->getId());

                        $followerNumb = $pm::getFollowerNumb($user->getId());
                        $followedNumb = $pm::getFollowedNumb($user->getId());
                        $view = new VUser();

                        //check if the Logged User is following the visited User
                        if($follow !== null)
                        {
                            $followCheck = true;
                        }else{
                            $followCheck = false;
                        }
                        if(count($postUser) === 0)
                        {
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, null, null, $followCheck, $followerNumb, $followedNumb);
                        }else{
                            $arrayLikeNumb = array();
                            foreach($postUser as $p)
                            {
                                //associative array for the number of like
                                $arrayLikeNumb[$p->getId()] = $pm::getLikeNumber($p->getId());
                            }
                            $view->uploadUserInfo($user, $profileProPic, $personalUser, $personalProPic, $postUser, $arrayLikeNumb, $followCheck, $followerNumb, $followedNumb);
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

    /**
     * check the request: if Get load the settings page compiling the form withe the user data
     * if Post check the attributes changed
     */
    public static function settings($param)
    {
        if(UServer::getRequestMethod() == "GET")
        {
            //param 0 load the page
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
            //param 1 Credential form (bio, hobby ecc)
            if($param == 1)
            {
                $user->setBio($_POST['Bio']);
                $user->setWorking($_POST['Working']);
                $user->setStudiedAt($_POST['StudiedAt']);
                $user->setHobby($_POST['Hobby']);
                $pm::uploadObj($user);
                header('Location: /Agora/User/personalProfile');
            //param 2 Username
            }elseif($param == 2)
            {
                if($user->getUsername() == $_POST['username']){
                    header('Location: /Agora/User/personalProfile');
                }else{
                    if($pm::verifyUserUsername($_POST['username']) == false)
                    {
                        $user->setUsername($_POST['username']);
                        $pm::uploadObj($user);
                        header('Location: /Agora/User/personalProfile');
                    }else{
                        $pm = FPersistentManager::getInstance();
                        USession::getInstance();

                        $userId = USession::getSessionElement('user');
                        $user = $pm::retriveObj(EUser::getEntity(), $userId);
                        $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                        $view->usernameError($user , true, $proPic);
                    }
                }



            //param 3 Password
            }elseif($param == 3)
            {
                $newPass = $_POST['password'];
                $user->setPassword($newPass);
                $pm::uploadObj($user);
                header('Location: /Agora/User/personalProfile');
            //param 4 ProPic
            }elseif($param == 4)
            {
                if($_FILES['imageFile']['size'] > 0)
                {
                    $uploadedImage = $_FILES['imageFile'];
                    $checkUploadImage = self::uploadImage($uploadedImage);
                    if($checkUploadImage == 'UPLOAD_ERROR_OK' || $checkUploadImage == 'TYPE_ERROR' || $checkUploadImage == 'SIZE_ERROR'){

                        $pm = FPersistentManager::getInstance();
                        USession::getInstance();

                        $userId = USession::getSessionElement('user');
                        $user = $pm::retriveObj(EUser::getEntity(), $userId);
                        $proPic = $pm::retriveObj(EImage::getEntity(), $user->getIdImage());

                        $view->FileError($user, $proPic );
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

    /**
     * check if the Uploaded image is ok and upload it in the database
     */
    public static function uploadImage($file){
        $check = CPost::validateImage($file);
        if($check[0]){
            $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
            return $image;
        }else{
            return $check[1];
        }
    }

    /**
     * load all the post finded by a specifyc category
     */
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
                //load the VIP Users and their profile Images
                $vipUsers = $pm::loadVip();
                $vipPic = array();
                $vipFollower = array();
            

                foreach($vipUsers as $v)
                {
                    //associative array for the Vip's images
                    $vipPic[$v->getId()] = $pm::retriveObj(EImage::getEntity(), $v->getIdImage());
                    //associative array for Vip's followers number
                    $vipFollower[$v->getId()] = $pm::getFollowerNumb($v->getId());
                }

                $postCategory = $pm::loadPostPerCategory($category);

                if(count($postCategory) > 0)
                {
                    foreach($postCategory as $p)
                    {
                        $usersPic[$p->getUser()->getId()] = $pm::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage());
                    }
                    $view->category($user, $proPic, $postCategory, $usersPic, $vipUsers, $vipPic, $vipFollower);
                }else{
                    $view->category($user, $proPic, null,null, $vipUsers, $vipPic, $vipFollower);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    /**
     * load a limit number of posts that are not belonged to the logged user, so this page is for discover new Users
     */
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
                //load the VIP Users and their profile Images
                $vipUsers = $pm::loadVip();
                $vipPic = array();
                $vipFollower = array();
            

                foreach($vipUsers as $v)
                {
                    //associative array for the Vip's images
                    $vipPic[$v->getId()] = $pm::retriveObj(EImage::getEntity(), $v->getIdImage());
                    //associative array for Vip's followers number
                    $vipFollower[$v->getId()] = $pm::getFollowerNumb($v->getId());
                }

                $postExplore = $pm::loadPostInExplore($user->getId());

                if(count($postExplore) > 0)
                {
                    foreach($postExplore as $p)
                    {
                        //asscoiative array for the users profile pic 
                        $usersPic[$p->getUser()->getId()] = $pm::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage());
                    }
                    $view->explore($user, $proPic, $postExplore, $usersPic, $vipUsers, $vipPic, $vipFollower);
                }else{
                    $view->explore($user, $proPic, null,null, $vipUsers, $vipPic, $vipFollower);
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

    /**
     * return a page with a list of Users who are followed by the User logged 
     */
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

    /**
     * return a page with a list of Users who are following the User logged 
     */
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

    /**
     * method to follow a user, the check is in the profile() method
     */
    public static function follow($followedId)
    {
        if(UServer::getRequestMethod() == "POST")
        {
            if(CUser::isLogged())
            {
                $pm = FPersistentManager::getInstance();

                USession::getInstance();
                $userId = USession::getSessionElement('user');

                //new Follow Object
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

    /**
     * method to unfollow a user, the check is in the profile() method
     */
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