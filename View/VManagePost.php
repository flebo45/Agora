<?php

class VManagePost{
    
    /**
    * @var Smarty
    */
    private $smarty;

    public function __construct(){
 
        $this->smarty = StartSmarty::configuration();
 
    }

    public function showCreationForm($user, $proPic){
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic',$proPic);
        $this->smarty->display('creation_post.tpl');
    }

    public function uploadFileError($error){
        $this->smarty->assign('errore', $error);
        $this->smarty->display('errore.tpl');
    }

    public function prova($a, $b, $c, $d){
        $this->smarty->assign('titolo', $a);
        $this->smarty->assign('descrizione', $b);
        $this->smarty->assign('categoria', $c);
        $this->smarty->assign('file', $d);
        $this->smarty->display('errore.tpl');

    }

    public function showPost($user, $userPic, $visitedUserPic, $post, $comments, $likeNumb, $followedNumb, $followerNumb)
    {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('userPic', $userPic);
        $this->smarty->assign('post', $post);
        $this->smarty->assign('comments', $comments);
        $this->smarty->assign('likeNumb', $likeNumb);
        $this->smarty->assign('visitedUserPic', $visitedUserPic);
        $this->smarty->assign('followerNumb', $followerNumb);
        $this->smarty->assign('followedNumb', $followedNumb);
        $this->smarty->display('visualization_post.tpl');
    }

    public function showLikesList($userList, $usersPic)
    {
        $this->smarty->assign('userLike', $userList);
        $this->smarty->assign('userPic', $usersPic);
        $this->smarty->display('userlist.tpl');
    }
}