<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$postId = 1;

//$post = $pm::retriveObj(EPost::getEntity(), $postId);

$likesNumber = $pm::getLikeNumber($postId);

print_r($likesNumber);
