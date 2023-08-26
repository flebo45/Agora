<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$email = $pm::verifyUsername('flebo45');

$user = $pm::retriveUser($email[0]);

echo $user->getId();