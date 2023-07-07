<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();
$id = 1;
$bio = "new Bio";

$user = $pm::selectUser($id);
$user->setBio();
$pm::createOrUpdateUser($user);