<?php

require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$cat = "cacca";

$posts = $pm::loadPostPerCategory($cat);

print_r($posts);
