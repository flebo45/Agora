<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 1;

$user = $pm::retriveUser($id);

$id2 = 2;
$id3 = 3;

$user2 = $pm::retriveUser($id2);
$user3 = $pm::retriveUser($id3);

$user->follow($user2);
$pm::uploadUser($user);
$pm::uploadUser($user2);

$user->follow($user3);
$pm::uploadUser($user);
$pm::uploadUser($user3);

/*$user->setVip(true);
$user2->setVip(true);
$user3->setVip(true);
$pm::uploadUser($user);
$pm::uploadUser($user2);
$pm::uploadUser($user3);*/

