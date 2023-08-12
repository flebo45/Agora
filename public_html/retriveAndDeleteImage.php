<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idImage = 2;

$image = $pm::retriveImage($idImage);

$pm::deleteImage($image);

