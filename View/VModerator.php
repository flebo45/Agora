<?php

class VModerator{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    public function showReportList($modUsername, $reportedPost, $reportedComment)
    {
        $this->smarty->assign('modUsername', $modUsername);
        $this->smarty->assign('reportedPost', $reportedPost);
        $this->smarty->assign('reportedComment', $reportedComment);
        $this->smarty->display('adminP.tpl');
    }

    public function showLoginForm()
    {
        $this->smarty->assign('error', false);
        $this->smarty->display('Admin-login.tpl');
    }

    public function loginError(){
        $this->smarty->assign('error', true);
        $this->smarty->display('Admin-login.tpl');
    }

}