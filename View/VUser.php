<?php

class VUser{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($user,$userPic, $postInHome, $vipUsers, $vipPic){
        
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic', $userPic);
        $this->smarty->assign('arrayPostInHome',$postInHome);
        $this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->assign('vipPic', $vipPic);
        $this->smarty->display('home.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showLoginForm(){
        $this->smarty->assign('error', false);
        $this->smarty->display('login.tpl');
    }

     /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadPersonalUserInfo($user, $proPic, $arrayPostUser, $arrayLikeNumb){
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user',$user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayLikeNumb', $arrayLikeNumb);
        $this->smarty->display('personalProfile.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadUserInfo($user, $userPic, $personalUser, $personalPic, $arrayPostUser, $arrayLikeNumb, $follow){
        
        $this->smarty->assign('user',$user);
        $this->smarty->assign('userPic',$userPic);
        $this->smarty->assign('personalUser',$personalUser);
        $this->smarty->assign('personalPic',$personalPic);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayLikeNumb', $arrayLikeNumb);
        $this->smarty->assign('follow',$follow);
        $this->smarty->display('profile.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError($error) {
        $this->smarty->assign('error',$error);
        $this->smarty->display('login.tpl');
    }

    public function usernameError($user , $error, $propic){
        $this->smarty->assign('errorImg',false);
        $this->smarty->assign('error' , $error);
        $this->smarty->assign('user',$user);
        $this->smarty->assign('userPic',$propic);
        $this->smarty->display('setting.tpl');
    }
    /**
     * @throws SmartyException
     */
    public function loginBan() {
        $this->smarty->assign('ban',"true");
        $this->smarty->display('login.tpl');
    }

    public function settings($user, $proPic){
        $this->smarty->assign('errorImg',false);
        $this->smarty->assign('error',false);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->display('setting.tpl');
    }

    public function explore($user,$proPic, $arrayPostInExplore){

        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('posts',$arrayPostInExplore);
        $this->smarty->display('explore.tpl');
    }

    public function category($user, $proPic, $postInExplore){
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('arrayPostInExplore', $postInExplore);
        $this->smarty->display('explore.tpl');
    }

    public function FileError($user, $proPic ){
        $this->smarty->assign('errorImg',true);
        $this->smarty->assign('error',false);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->display('setting.tpl');
    }
}