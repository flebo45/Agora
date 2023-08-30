<?php
require_once "bootstrap.php";
require_once "autoloader.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id  = 2;

$homePagePosts = $pm::loadHomePage($id);

foreach($homePagePosts as $p)
{
    foreach($p->getImages() as $i)
    {
        echo $i->getName();
    }
}