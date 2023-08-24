<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 2;

$post = $pm::retrivePost($id);

foreach($post->getImages() as $i){
    echo $i->getId();
}