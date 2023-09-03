<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$postId = 3;

//$post = $pm::retriveObj(EPost::getEntity(), $postId);

$userList = $pm::getLikesUserOfAPost($postId);

print_r($userList);
