<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$loggedUserId = 2;
$user = $pm::retriveUser($loggedUserId);

$posts = $pm::loadHomePage($user);

usort($posts, ['CManagePost', 'comparePostsByCreationTime']);

foreach($posts as $p){
    echo $p->getId();
}
