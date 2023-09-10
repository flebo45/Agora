<?php

class VUser{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($user,$userPic, $postInHome, $followedPic, $vipUsers, $vipPic, $vipFollower){
        
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic', $userPic);
        $this->smarty->assign('arrayPostInHome',$postInHome);
        $this->smarty->assign('followedPic', $followedPic);
        $this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->assign('vipPic', $vipPic);
        $this->smarty->assign('vipFollower', $vipFollower);
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
    public function uploadPersonalUserInfo($user, $proPic, $arrayPostUser, $arrayLikeNumb,$followerNumb, $followedNumb){
        
        $this->smarty->assign('user',$user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayLikeNumb', $arrayLikeNumb);
        $this->smarty->assign('followerNumb',$followerNumb);
        $this->smarty->assign('followedNumb',$followedNumb);
        $this->smarty->display('personalProfile.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadUserInfo($user, $userPic, $personalUser, $personalPic, $arrayPostUser, $arrayLikeNumb, $follow, $followerNumb, $followedNumb){
        
        $this->smarty->assign('user',$user);
        $this->smarty->assign('userPic',$userPic);
        $this->smarty->assign('personalUser',$personalUser);
        $this->smarty->assign('personalPic',$personalPic);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayLikeNumb', $arrayLikeNumb);
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
        $this->smarty->assign('error',false);
        $this->smarty->assign('ban',true);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function settings($user, $proPic){
        $this->smarty->assign('errorImg',false);
        $this->smarty->assign('error',false);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->display('setting.tpl');
    }

    public function explore($user,$proPic, $arrayPostInExplore, $usersPic, $vipUsers, $vipPic, $vipFollower){

        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('posts',$arrayPostInExplore);
        $this->smarty->assign('exploreUsersPic',$usersPic);
        $this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->assign('vipPic', $vipPic);
        $this->smarty->assign('vipFollower', $vipFollower);
        $this->smarty->display('explore.tpl');
    }

    public function category($user, $proPic, $postInExplore, $usersPic, $vipUsers, $vipPic, $vipFollower){

        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->assign('posts', $postInExplore);
        $this->smarty->assign('exploreUsersPic',$usersPic);
        $this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->assign('vipPic', $vipPic);
        $this->smarty->assign('vipFollower', $vipFollower);
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