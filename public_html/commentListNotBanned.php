<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idPost = 1;
$post = $pm::retrivePost($idPost);

$comments = $pm::postCommentsListNotBanned($post);

//nelle control mettere una verifica se l'array è null 
foreach($comments as &$value){
    echo $value->getId();
    }