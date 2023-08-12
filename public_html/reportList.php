<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$reportedPost = $pm::reportedPostList();

foreach($reportedPost as &$report){
    echo $report->getId();
}