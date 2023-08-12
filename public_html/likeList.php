<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 1;
$post = $pm::retrivePost($idPost);

$likes = $pm::postLikeList($post);

//nelle control mettere una verifica se l'array è null 
foreach($likes as &$value){
    echo $value->getId();
    }
