<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$postId = 2;

//$post = $pm::retriveObj(EPost::getEntity(), $postId);

$comments = $pm::retriveCommentOnPost($postId);

 echo $comments->getId();
