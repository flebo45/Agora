<?php 

class VManagePost{

    /**
     * @var Smarty
     */

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    public function savePost(?){

    }

    public function creation_post($postID){

        $this->smarty->assign('postID', $postID);
        $this->smarty->display(creation_post.tpl);

    }

    public function modify_post($post, $postID, $images){

        $this->smarty->assign('post',$post);
        $this->smarty->assign('postID',$postID);
        $imageArray=[]

    }


}