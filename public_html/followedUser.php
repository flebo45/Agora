<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 1;

$user = $pm::retriveUser($id);

print_r($user->getFollowedNumber());