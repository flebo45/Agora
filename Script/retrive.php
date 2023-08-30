<?php

require_once "bootstrap.php";
require_once "autoloader.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();


$username = "flebo45";

$user = $pm::retriveUserOnUsername($username);


