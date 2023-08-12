<?php

require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 1;
$post = $pm::retrivePost($idPost);

$pm::deletePost($post);