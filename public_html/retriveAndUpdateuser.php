<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();
$id = 5;
//$bio = "new Bio";

$user = $pm::retriveUser($id);
if($user == null){
    echo 'null';
}
//$user->setBio($bio);

//$pm::uploadUser($user);