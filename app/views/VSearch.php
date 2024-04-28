<?php

class VSearch{

    
    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function showSearch($keyword, $searchedPosts, $searchedUsers)
    {
        $this->smarty->assign('searchedPost', $searchedPosts);
        $this->smarty->assign('searchedUser', $searchedUsers);
        
        $this->smarty->assign('keyword', $keyword);
        $this->smarty->display('search_result.tpl');
    }
}