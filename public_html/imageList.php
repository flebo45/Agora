<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 1;
$post = $pm::retrivePost($idPost);

$images = $pm::postImageList($post);

//nelle control mettere una verifica se l'array è null 
foreach($images as &$value){
    echo $value->getId();
    }