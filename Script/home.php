<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id  = 1;

$homePagePosts = $pm::loadHomePage($id);

print_r($homePagePosts[1]->getId());