<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$vips = $pm::loadVip();

foreach($vips as $v)
{
    echo $v->getId();
}