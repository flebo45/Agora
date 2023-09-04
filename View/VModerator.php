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
        $this->smarty->display('Admin-login.tpl');
    }

}