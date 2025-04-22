<?php
require_once __DIR__ . "/config/config.php";
if(USE_DOCTRINE){
    require_once __DIR__ . "/appORM/config/autoloader.php";
} else{
    require_once __DIR__ . "/app/config/autoloader.php";
}

$mod = new EModerator('admin', 'admin', 100, 'admin.admin@admin.com', 'Admin12!', 'admin1');

FPersistentManager::getInstance()->uploadObj($mod);