<?php
//require('Smarty/Smarty.class.php');

class StartSmarty{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->template_dir='src/templates/';
        $smarty->compile_dir='src/templates_c/';
        $smarty->config_dir='src/configs/';
        $smarty->cache_dir='src/cache/';
        return $smarty;
    }
}