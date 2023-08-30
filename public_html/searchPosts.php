<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$str = 'u';

$posts = $pm::loadSearchPost($str);
var_dump($posts);
foreach($posts as $p){
    echo $p->getId();
}

$users = $pm::loadSearchUser($str);

foreach($users as $u){
    echo $u->getId();
}
