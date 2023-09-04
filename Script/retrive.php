<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$modUsername = "mod123";

$mod = $pm::verifyModUsername($modUsername);

print_r($mod);