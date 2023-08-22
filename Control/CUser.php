<?php
//TODO  change attributes, follow, foto profilo, 
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
     */
    public static function home(){
        if(CUser::isLogged()){
            $pm = FPersistentManager::getInstance();
            $view = new VUser();

            $userId = USession::getSessionElement('user');
            $user = $pm::retriveUser($userId);
            $postsInHome = $pm::loadHomePage($user);
            if($postsInHome == null){
                //view della pagina vuota
                $view->home();
            }else{
                usort($postsInHome, ['CManagePost', 'comparePostsBycreationTime']);
                //now $postInHome is modified
            }
            //pass attributes of the post to the view to show it in the homepage 
        }
        else{

        }

    }

    public static function login(){
       $pm = FPersistentManager::getInstance();

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
            $email = $pm::verifyEmail($_POST['email']);
            if($email != null){
                $hashedPassword = hash('sha256', $_POST['password'] );
                $user = $pm::retriveUser($email);
                if($hashedPassword == $user->getHashedPassword()){
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
                    $view->loginError();
                }
                
            }else{
                $view->loginError();
            }
        }
    }

    public static function registration(){
        if(UServer::getRequestMethod() == "GET"){
            $view = new VUser();
            if(self::isLogged()){
                header('Location: /Agora/User/home');
            }
            else{
                $view->showRegistrationForm();
            }
        }elseif(UServer::getRequestMethod() == "POST"){
            self::checkRegistration();
        }
    }

    public static function checkRegistration(){
        if(UServer::getRequestMethod() != 'GET'){
            $pm = FPersistentManager::getInstance();
            $email = $pm::verifyEmail($_POST['email']);
            $view = new VUser();
            if($email == null){
                $username = $pm::verifyUsername($_POST['username']);
                if($username == null){
                    $user = new User($_POST['name'], $_POST['surname'],$_POST['age'], $_POST['email'], $_POST[-'username'],$_POST['password']);
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
        else{
            header('Location: /Agora/User/home');
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
                $post= $pm::userPostsList($personalUserId);
                //prendere i dati da user per le view

                $view->uploadPersonalUserInfo($personalUser,$post);

                //caricare imm profilo
                //caricare i post(caricare anbche immagini post)
            }
            else{
                header('Location: /Agora/User/login');
            }
        }
    }

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
                $post= $pm::userPostsList($userId);
                //prendere i dati da user per le view

                $view->uploadUserInfo($user,$personalUser,$post);
                //caricare imm profilo
                //caricare i post(caricare anbche immagini post)
            }
            else{
                header('Location: /Agora/User/login');
            }
        }
    }
}