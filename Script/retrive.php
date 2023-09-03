<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idUser = 1;

//$post = $pm::retriveObj(EPost::getEntity(), $postId);

$followedNumb = $pm::getFollowedNumb($idUser);

$followerNumb = $pm::getFollowerNumb($idUser);

print_r($followedNumb);
print_r($followerNumb);
