<?php

class VUser{
    
    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($user, $arrayPostInHome, $arrayImagesPosts, $vipUsers/*$userimagini*/ /*$colorLabel, $backgroundLabel*/){
        
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('arrayPostInHome',$arrayPostInHome);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->display('home.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showLoginForm(){
        $this->smarty->assign('siteName', 'Agorà');
        $this->smarty->display('login.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadPersonalUserInfo($user, $arrayPostUser, $arrayImagesPosts){
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user',$user);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        $this->smarty->display('personalProfile.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadUserInfo($user,$personalUser,$arrayPostUser, $arrayImagesPosts){
        $this->smarty->assign('personalUser',$personalUser);
        $this->smarty->assign('user',$user);
        $this->smarty->assign('postList',$arrayPostUser);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        $this->smarty->display('profile.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError() {
        $this->smarty->assign('error',"errore");
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function loginBan() {
        $this->smarty->assign('ban',"true");
        $this->smarty->display('login.tpl');
    }

    public function settings($user){
        $this->smarty->assign('user', $user);
        $this->smarty->display('setting.tpl');
    }

    public function explore($user, $arrayPostInExplore, $arrayImagesPosts, /*$vipUsers/*$userimagini*/ /*$colorLabel, $backgroundLabel*/){

        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('arrayPostInHome',$arrayPostInExplore);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        $this->smarty->assign('user', $user);
        //$this->smarty->assign('arrVip', $vipUsers);
        $this->smarty->display('explore.tpl');
    }


}