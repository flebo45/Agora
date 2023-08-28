<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$users = $pm::topUserFollower();

foreach($users as $u){
    echo $u['id'];
}