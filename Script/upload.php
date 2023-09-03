<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$follow = new EUserFollow(1,2);
$pm::uploadObj($follow);
/**$id = 1;

$user = $pm::retriveObj(EUser::getEntity(), $id);

$title = "Vacanza a Catanzaro";
$description = "Vacanza pazzesca in quel di catanzaro";
$category = "Travel";

$post = new EPost($title, $description, $category);

$post->setUser($user);
$pm::uploadObj($post);**/

/*$name = 'sakura.png';
$size = 1024;
$type = 'image/png';
$imageData = "ziopera";

$postPic1 = new EImage($name, $size, $type, $imageData);

$pm::uploadImagePost($postPic1, $post);*/