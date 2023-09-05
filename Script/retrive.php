<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 12;

$post = $pm::retriveObj(EPost::getEntity(), $idPost);

var_dump($post);