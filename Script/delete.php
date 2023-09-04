<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 3;

$report = $pm::retriveObj(EReport::getEntity(), $id);

$pm::deleteReport($report);



//remeber in the foundation, if i delete the post i need to delete all the Like