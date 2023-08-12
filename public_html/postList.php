<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idUser = 1;
$user = $pm::retriveUser($idUser);

$posts = $pm::userPostsList($user);


//nelle control mettere una verifica se l'array è null 
foreach($posts as &$value){
    echo $value->getId();
    }

