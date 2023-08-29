<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 2;

$user = $pm::retriveUser($id);

$arrayExplore = $pm::postInExplore($user);

foreach($arrayExplore as $p){
    echo $p->getId();
}   