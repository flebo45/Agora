<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$id = 1;

$att = "12345678";

$user = $pm::retriveObj(EUser::getEntity(), $id);

if(password_verify($att, $user->getPassword())){
    echo "The Password Is Correct";
}else{
    echo "Password not correct";
}