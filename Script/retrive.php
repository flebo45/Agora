<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idUser = 1;
$idFollowed = 2;

$follow = $pm::retriveFollow($idUser, $idFollowed);

print_r($follow);