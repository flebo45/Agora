<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idLike = 1;

$like = $pm::retriveLike($idLike);

$pm::deleteLike($like);