<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idComment = 4;

$comment = $pm::retriveComment($idComment);

$pm::deleteComment($comment);