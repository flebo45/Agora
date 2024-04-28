<?php

class VUser{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($userAndPropic, $postInHome, $arrayVipUserPropicFollowNumb){
        
        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic', $userAndPropic[0][1]);
        $this->smarty->assign('arrayPostInHome',$postInHome);
        $this->smarty->assign('arrVip', $arrayVipUserPropicFollowNumb);
        
        $this->smarty->display('home.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showLoginForm(){
        $this->smarty->assign('error', false);
        $this->smarty->assign('ban',false);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('login.tpl');
    }

     /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadPersonalUserInfo($userAndPropic, $postProfileAndLikes,$followerNumb, $followedNumb){
        
        $this->smarty->assign('user',$userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->assign('postList',$postProfileAndLikes);
        $this->smarty->assign('followerNumb',$followerNumb);
        $this->smarty->assign('followedNumb',$followedNumb);
        $this->smarty->display('personalProfile.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadUserInfo($userAndPropic, $personalUserAndPropic, $postUser, $follow, $followerNumb, $followedNumb){
        
        $this->smarty->assign('user',$userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->assign('personalUser',$personalUserAndPropic[0][0]);
        $this->smarty->assign('personalPic',$personalUserAndPropic[0][1]);
        $this->smarty->assign('postList',$postUser);

        $this->smarty->assign('followerNumb',$followerNumb);
        $this->smarty->assign('followedNumb',$followedNumb);
    
        $this->smarty->assign('follow',$follow);
        $this->smarty->display('profile.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError() {
        $this->smarty->assign('error',true);
        $this->smarty->assign('ban',false);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('login.tpl');
    }
    public function registrationError() {
        $this->smarty->assign('error',false);
        $this->smarty->assign('ban',false);
        $this->smarty->assign('regErr',true);
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function usernameError($userAndPropic , $error){
        $this->smarty->assign('errorImg',false);
        $this->smarty->assign('error' , $error);
        $this->smarty->assign('user',$userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->display('setting.tpl');
    }
    /**
     * @throws SmartyException
     */
    public function loginBan() {
        $this->smarty->assign('error',false);
        $this->smarty->assign('ban',true);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function settings($userAndPropic){
        $this->smarty->assign('errorImg',false);
        $this->smarty->assign('error',false);
        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->display('setting.tpl');
    }

    public function explore($userAndPropic, $postExplore, $arrayVipUserPropicFollowNumb){

        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->assign('posts',$postExplore);
        $this->smarty->assign('arrVip', $arrayVipUserPropicFollowNumb);
        $this->smarty->display('explore.tpl');
    }

    public function category($userAndPropic, $postCategory, $arrayVipUserPropicFollowNumb){

        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->assign('posts', $postCategory);
        $this->smarty->assign('arrVip', $arrayVipUserPropicFollowNumb);
        $this->smarty->display('explore.tpl');
    }

    public function FileError($userAndPropic){
        $this->smarty->assign('errorImg',true);
        $this->smarty->assign('error',false);
        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
        $this->smarty->display('setting.tpl');
    }
}