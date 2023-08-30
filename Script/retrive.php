<?php

require_once "bootstrap.php";
require_once "autoloader.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();


$image = $pm::retriveProPicInfo(1);

foreach($image as $i){
    print_r($i->getId());
}
