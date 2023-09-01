<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 1;

$postInExplore = $pm::loadPostInExplore($id);

foreach($postInExplore as $p)
{
    echo $p->getId();
}