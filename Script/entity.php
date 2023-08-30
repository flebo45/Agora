<?php

require_once "bootstrap.php";
require_once "autoloader.php";
$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();
//-------------------------ENTITY---------------------------------

$name = "Alessio";
$surname = "Torrieri";
$year = 2002;
$email = "alessio.torrieri@gmail.com";
$password = "12345678";
$username = "flebo45";

$user = new EUser($name, $surname, $year, $email, $password, $username);

$pm::uploadObj($user);

$name = "Alessio";
$surname = "Martinelli";
$year = 2001;
$email = "alessio.martinelli@gmail.com";
$password = "12345678";
$username = "aleMammt0";

$user2 = new EUser($name, $surname, $year, $email, $password, $username);

$pm::uploadObj($user2);

//------------------------FOLLOW------------------------------------

$follow = new EUserFollow($user2->getId(), $user->getId());

$pm::uploadObj($follow);

//-------------------------POST-------------------------------------

$title = "Vacanza a Catanzaro";
$description = "Vacanza pazzesca in quel di catanzaro";
$category = "Travel";

$post = new EPost($title, $description, $category);

$post->setUser($user);
$pm::uploadObj($post);

$title = "Le nuove Nike DunkLow fanno paura";
$description = "pazzesce";
$category = "Hobby";

$post2 = new EPost($title, $description, $category);

$post2->setUser($user2);
$pm::uploadObj($post2);

//-------------------------COMMENT---------------------------------------

$body = "Ahahahah gg";

$comment = new EComment($body, $user2, $post->getId());

$pm::uploadObj($comment);

//--------------------------LIKE----------------------------------------

$like = new ELike($user2->getId(), $post->getId());

$pm::uploadObj($like);

//------------------------REPORT--------------------------------------

$description = "Questo post insulta i calabresi";
$type = "Violence";

$report = new EReport($description, $type, $user2->getId());

$report->setPost($post);

$pm::uploadObj($report);

//-----------------------IMAGE-----------------------------------------
$name = 'supra.jpeg';
$size = 1024;
$type = 'image/jpeg';
$imageData = "ziopera";

$proPic = new EImage($name, $size, $type, $imageData);

$pm::uploadObj($proPic);

$user->setIdImage($proPic->getId());
$pm::uploadObj($user);

$name = 'sakura.png';
$size = 1024;
$type = 'image/png';
$imageData = "ziopera";

$postPic1 = new EImage($name, $size, $type, $imageData);
$post->addImage($postPic1);
$postPic1->setPost($post);

$pm::uploadObj($post);
$pm::uploadObj($postPic1);

$name = 'zio.jpg';
$size = 1024;
$type = 'image/jpg';
$imageData = "ziopera";

$postPic2 = new EImage($name, $size, $type, $imageData);
$post->addImage($postPic2);
$postPic2->setPost($post);

$pm::uploadObj($post);
$pm::uploadObj($postPic2);