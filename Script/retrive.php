<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idImage = 6;

$proPic= $pm::retriveProPicInfo($idImage);

var_dump($proPic);


