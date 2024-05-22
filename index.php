<?php
require_once __DIR__ . "/config/config.php";
if(USE_DOCTRINE){
    require_once __DIR__ . "/appORM/config/autoloader.php";
    require_once __DIR__ . "/appORM/install/StartSmarty.php";
    require_once __DIR__ . "/appORM/install/Installation.php";
}else{
    require_once __DIR__ . "/app/config/autoloader.php";
    require_once __DIR__ . "/app/install/StartSmarty.php";
    require_once __DIR__ . "/app/install/Installation.php";
}

Installation::install();

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);