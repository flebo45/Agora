<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$arrVip = $pm::loadVip();

foreach($arrVip as $u){
    echo $u->getId();
}