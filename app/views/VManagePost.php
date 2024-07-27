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
    public function showCreationForm($userAndPropic){
        $this->smarty->assign('user', $userAndPropic[0][0]);
        $this->smarty->assign('userPic',$userAndPropic[0][1]);
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
    public function showPost($userAndPropic, $visitedUserAndPic, $post, $commentsAndUserPic, $numericInfo, $like,  $followCheck)
    {
        if($userAndPropic === null){
            $this->smarty->assign('user', null);
            $this->smarty->assign('userPic', null);
        }else{
            $this->smarty->assign('user', $userAndPropic[0][0]);
            $this->smarty->assign('userPic', $userAndPropic[0][1]);
        }

        if(is_array($like)){
            $checkLike = false;
        }else{
            $checkLike = true;
        }
        
        $this->smarty->assign('post', $post);
        $this->smarty->assign('comments', $commentsAndUserPic);
        
        $this->smarty->assign('visitedUserPic', $visitedUserAndPic[0][1]);
        $this->smarty->assign('numericInfo', $numericInfo);
        $this->smarty->assign('checkLike', $checkLike);
        $this->smarty->assign('followCheck', $followCheck);
        $this->smarty->display('visualization_post.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function showUsersList($usersListAndPropic, $userId, $param)
    {
        $this->smarty->assign('userList', $usersListAndPropic);
        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('param', $param);
        $this->smarty->display('userlist.tpl');
    }


}