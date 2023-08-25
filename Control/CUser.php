<?php
//TODO  change attributes, follow, foto profilo, 

//TODO change $_POST[] param in changeCredential() 
//TODO vedere come salvare cose nella registrazione se uno sbaglia email o username 
class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged(){
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
    public static function isBanned(){
        $userId = USession::getSessionElement('user');
        $pm = FPersistentManager::getInstance();
            
        $user = $pm::retriveUser($userId);
        $view = new VUser();

        if($user->isBanned()){
            USession::unsetSession();
            USession::destroySession();
            $view->loginBan();
        }
        
    }

    /**
     * show the home page of the user
     * if logged show all the posts of the followed user in time order desc
     * @throws SmartyException
     */
    public static function home(){
        if(CUser::isLogged()){
            $pm = FPersistentManager::getInstance();
            $view = new VUser();

            $userId = USession::getSessionElement('user');
            $user = $pm::retriveUser($userId);
            $arrayHome = $pm::loadHomePage($user);  //array containing posts and images

            $postsInHome = $arrayHome['posts'];
            $imagesOfPosts = $arrayHome['images'];

            /**if(USession::isSetSessionElement('colorLabel')){
                $colorLabel = USession::getSessionElement('colorLabel');
            }else{
                $colorLabel = 'white';
            }
            if(USession::isSetSessionElement('backgroundLabel')){
                $backgroundLabel = USession::getSessionElement('backgroundLabel');
            }else{
                $backgroundLabel = 'red';
            }**/
            
            if($postsInHome == null){
                //view della pagina vuota
            $view->home($user, null, null/*userimg*/ /*$colorLabel, $backgroundLabel*/);
            }else{
                //now $postInHome is modified
            $view->home($user, $postsInHome, $imagesOfPosts /*$postsInHome*/ /*$colorLabel, $backgroundLabel*/);
            }
            //pass attributes of the post to the view to show it in the homepage 
        }
        else{
            header('Location: /Agora/User/login');
        }

    }

    public static function login(){
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

    public static function checkLogin(){
        if(UServer::getRequestMethod() != 'GET'){
            $pm = FPersistentManager::getInstance();
            $view = new VUser();
            $userArr = $pm::verifyUsername($_POST['username']);
            if($userArr != null){
                $hashedPassword = hash('sha256', $_POST['password'] );
                $user = $pm::retriveUser($userArr[0]);
                if($hashedPassword == $user->getHashedPassword()){
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

    public static function registration(){
        if(UServer::getRequestMethod() == "POST"){
            self::checkRegistration();
        }
        else{
            header('Location: /Agora/User/login');
        }
    }

    public static function checkRegistration(){
        $pm = FPersistentManager::getInstance();
        $email = $pm::verifyEmail($_POST['email']);
        $view = new VUser();
        if($email == null){
            $username = $pm::verifyUsername($_POST['username']);
            if($username == null){
                $user = new User($_POST['name'], $_POST['surname'],$_POST['age'], $_POST['email'], $_POST['username'],$_POST['password']);
                $pm::uploadUser($user);
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

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Agora/User/login');
    }

    public static function personalProfile(){
        $view = new VUser();
        $pm = FPersistentManager::getInstance();
        if(UServer::getRequestMethod() == "GET") {
            if(CUser::isLogged()){
                USession::getInstance();

                $personalUserId = USession::getSessionElement('user');
                $personalUser = $pm::retriveUser($personalUserId);

                //post
                $post= $pm::userPostsList($personalUser);
                //prendere i dati da user per le view

                $view->uploadPersonalUserInfo($personalUser,$post);

                //caricare imm profilo
                //caricare i post(caricare anbche immagini post)
            }
            else{
                header('Location: /Agora/User/login');
            }
        }
        else{
            header('Location: /Agora/User/home');
        }
    }
//TODO verify that the user exists
    public static function profile($userId){
        $view = new VUser();
        $pm = FPersistentManager::getInstance();
        if(UServer::getRequestMethod() == "GET") {
            if(CUser::isLogged()){
                USession::getInstance();

                $personalUserId = USession::getSessionElement('user');
                $personalUser = $pm::retriveUser($personalUserId);

                $user = $pm::retriveUser($userId);

                //post
                $post= $pm::userPostsList($user);
                //prendere i dati da user per le view
                if($personalUser->getId() == $user->getId()){
                    header('Location: /Agora/User/personalProfile');
                }else{
                      
                $view->uploadUserInfo($user,$personalUser,$post);
                //caricare imm profilo
                //caricare i post(caricare anbche immagini post)
                
                }
              
            }
            else{
                header('Location: /Agora/User/login');
            }
        }
    }

    public static function changeCredentials(){
        $pm = FPersistentManager::getInstance();
        if(UServer::getRequestMethod() == 'POST'){
            if(CUser::isLogged()){
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveUser($userId);

                if($_POST['bio'] != null){
                    $user->setBio($_POST['bio']);
                }

                if($_POST['work'] != null){
                    $user->setWorking($_POST['work']);
                }

                if($_POST['study'] != null){
                    $user->setStudiedAt($_POST['study']);
                } 

                if($_POST['hobby'] != null){
                    $user->setHobby($_POST['hobby']);
                }

                $pm::uploadUser($user);
            }
            else{
                header ('Location: /Agora/User/login');
            }
        }
    }

    public static function changeUsername(){
        $pm = FPersistentManager::getInstance();
        
        if(UServer::getRequestMethod() == 'POST'){
            if(CUser::isLogged()){
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveUser($userId);
                $probUser = $pm::verifyUsername($_POST['username']);
                if($probUser == null){
                    $user->setUsername($_POST['username']);
                    $pm::uploadUser($user);
                    header('Location: /Agora/User/home');
                }
                else{
                    $view = new VUser();
                    $view->errorUsername();
                }
            }
        }
    }

    public static function changePassword(){
        $pm = FPersistentManager::getInstance();

        if(UServer::getRequestMethod() == 'POST'){
            if(CUser::isLogged()){
                $userId = USession::getSessionElement('user');
                $user = $pm::retriveUser($userId);
                
            }
        }
    }

    public static function category($category){
        $pm = FPersistentManager::getInstance();
        if(UServer::getRequestMethod() == 'GET'){
            if(CUser::isLogged()){
                $view = new VUser();
                $posts = $pm::loadPostPerCategory($category);
                if(! empty($posts)){
                    $view->category($posts);
                }else{
                    header('Location: /Agora/User/home');
                }
            }else{
                header('Location: /Agora/User/login');
            }
        }else{
            header('Location: /Agora/User/home');
        }
    }

}