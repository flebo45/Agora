<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 3;

$user = $pm::retriveUser($id);

if($user->getProfileImage() !== null){
    echo 1;
}
