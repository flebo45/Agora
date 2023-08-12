<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idReport = 2;

$report = $pm::retriveReport($idReport);

$pm::deleteReport($report);