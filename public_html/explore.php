<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 2;

$user = $pm::retriveUser($id);

$arrayExplore = $pm::loadArrayExplore($user);

foreach($arrayExplore['posts'] as $p){
    echo $p->getId();
}   