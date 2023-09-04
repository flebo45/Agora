<?php

class VModerator{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    public function showReportList($modUsername, $reportedPost, $postUserPic, $reportedComment, $commentUserPic)
    {
        $this->smarty->assign('modUsername', $modUsername);
        $this->smarty->assign('reportedPost', $reportedPost);
        $this->smarty->assign('postUserPic', $postUserPic);
        $this->smarty->assign('reportedComment', $reportedComment);
        $this->smarty->assign('commentUserPic', $commentUserPic);
        $this->smarty->display('adminP.tpl');
    }

}