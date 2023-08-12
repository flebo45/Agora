<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 1;
$idUser = 1;

$newTitle = "Vacanza apocalitica a Catanzaro";

$post = $pm::retrivePost($idPost);
$user = $pm::retriveUser($idUser);

$post->setTitle($newTitle);

$pm::uploadPost($post, $user);
