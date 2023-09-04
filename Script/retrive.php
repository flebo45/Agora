<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$reportedPost = $pm::getReportedPost();

foreach($reportedPost as $rp)
{
   echo $rp->getId();
}