<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 1;

$followed = $pm::getFollowedList($id);

foreach($followed as $f)
{
    echo $f->getId();
}