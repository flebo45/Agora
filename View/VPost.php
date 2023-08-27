<?php

class VPost
{
    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    public function visualizzationPost($post, $user){
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user', $user);
        this->smarty->assign('post', $post);
        $this->smarty->display('visualization_post.tpl');
    }
}