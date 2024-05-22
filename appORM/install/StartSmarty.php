<?php
require(__DIR__ . '/../../libs/Smarty/Smarty.class.php');

class StartSmarty{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->template_dir= __DIR__ . '/../../libs/Smarty/templates/';
        $smarty->compile_dir= __DIR__ . '/../../libs/Smarty/templates_c/';
        $smarty->config_dir= __DIR__ . '/../../libs/Smarty/configs/';
        $smarty->cache_dir= __DIR__ . '/../../libs/Smarty/cache/';
        return $smarty;
    }
}