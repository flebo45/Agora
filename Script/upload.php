<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();
/*
$mod = new EModerator('nome', 'cognome', 20, 'admin@admin', 'admin', 'mod123');

$pm::uploadObj($mod);*/
$comm = $pm::retriveObj(EComment::getEntity(), 8);

$report = new EReport('denkjsdfbjsb', 'violence', 2);
$report->setComment($comm);
$pm::uploadObj($report);
