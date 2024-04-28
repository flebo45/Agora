<?php

class VModerator{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function showReportList($modUsername, $reportedPost, $reportedComment)
    {
        $this->smarty->assign('modUsername', $modUsername);
        $this->smarty->assign('reportedPost', $reportedPost);
        $this->smarty->assign('reportedComment', $reportedComment);
        $this->smarty->display('adminP.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function showLoginForm()
    {
        $this->smarty->assign('error', false);
        $this->smarty->display('Admin-login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function loginError(){
        $this->smarty->assign('error', true);
        $this->smarty->display('Admin-login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function visitUser($userAndPropic, $arrayPostUser, $followerNumb, $followedNumb, $modUsername){
        $this->smarty->assign('modUsername', $modUsername);
        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic', $userAndPropic[0][1]);
        $this->smarty->assign('arrayPostUser', $arrayPostUser);
        $this->smarty->assign('follower', $followerNumb);
        $this->smarty->assign('followed', $followedNumb);
        $this->smarty->display('UserProfileAdmin.tpl');
    }


    public function visitPost($post,$userPic,$modUsername){
        $this->smarty->assign('modUsername', $modUsername);
        $this->smarty->assign('post', $post);
        $this->smarty->assign('userPic', $userPic[0][1]);
        $this->smarty->display('adminPost.tpl');
    }
}