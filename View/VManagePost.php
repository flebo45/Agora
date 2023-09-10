<?php

class VManagePost{
    
    /**
    * @var Smarty
    */
    private $smarty;

    public function __construct(){
 
        $this->smarty = StartSmarty::configuration();
 
    }

    /**
     * @throws SmartyException
     */
    public function showCreationForm($user, $proPic){
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->display('creation_post.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function uploadFileError($error){
        $this->smarty->assign('errore', $error);
        $this->smarty->display('errore.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function showPost($user, $userPic, $visitedUserPic, $post, $comments, $likeNumb, $followedNumb, $followerNumb, $checkLike,  $followCheck)
    {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic', $userPic);
        $this->smarty->assign('post', $post);
        $this->smarty->assign('comments', $comments);
        $this->smarty->assign('likeNumb', $likeNumb);
        $this->smarty->assign('visitedUserPic', $visitedUserPic);
        $this->smarty->assign('followerNumb', $followerNumb);
        $this->smarty->assign('followedNumb', $followedNumb);
        $this->smarty->assign('checkLike', $checkLike);
        $this->smarty->assign('followCheck', $followCheck);
        $this->smarty->display('visualization_post.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function showUsersList($userList, $usersPic, $param)
    {
        $this->smarty->assign('userList', $userList);
        $this->smarty->assign('userPic', $usersPic);
        $this->smarty->assign('param', $param);
        $this->smarty->display('userlist.tpl');
    }


}