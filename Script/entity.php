<?php

require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

//-------------------------ENTITY---------------------------------

$name = "Alessio";
$surname = "Torrieri";
$year = 2002;
$email = "alessio.torrieri@gmail.com";
$password = "12345678";
$username = "flebo45";

$user = new EUser($name, $surname, $year, $email, $password, $username);

$em->persist($user);
$em->flush();

$name = "Alessio";
$surname = "Martinelli";
$year = 2001;
$email = "alessio.martinelli@gmail.com";
$password = "12345678";
$username = "aleMammt0";

$user2 = new EUser($name, $surname, $year, $email, $password, $username);

$em->persist($user2);
$em->flush();

//------------------------FOLLOW------------------------------------

$follow = new EUserFollow($user2->getId(), $user->getId());

$em->persist($follow);
$em->flush();

//-------------------------POST-------------------------------------

$title = "Vacanza a Catanzaro";
$description = "Vacanza pazzesca in quel di catanzaro";
$category = "Travel";

$post = new EPost($title, $description, $category);

$post->setUser($user);
$em->persist($post);
$em->flush();

$title = "Le nuove Nike DunkLow fanno paura";
$description = "pazzesce";
$category = "Hobby";

$post2 = new EPost($title, $description, $category);

$post2->setUser($user2);
$em->persist($post2);
$em->flush();

//-------------------------COMMENT---------------------------------------

$body = "Ahahahah gg";

$comment = new EComment($body, $user2, $post->getId());

$em->persist($comment);
$em->flush();

//--------------------------LIKE----------------------------------------

$like = new ELike($user2->getId(), $post->getId());

$em->persist($like);
$em->flush();

//------------------------REPORT--------------------------------------

$description = "Questo post insulta i calabresi";
$type = "Violence";

$report = new EReport($description, $type, $user2->getId());

$report->setPost($post);

$em->persist($report);
$em->flush();


//-----------------------IMAGE-----------------------------------------
$name = 'supra.jpeg';
$size = 1024;
$type = 'image/jpeg';
$imageData = "ziopera";

$proPic = new EImage($name, $size, $type, $imageData);

$em->persist($proPic);
$em->flush();

$user->setIdImage($proPic->getId());
$em->persist($user);
$em->flush();

$name = 'sakura.png';
$size = 1024;
$type = 'image/png';
$imageData = "ziopera";

$postPic1 = new EImage($name, $size, $type, $imageData);
$post->addImage($postPic1);
$postPic1->setPost($post);

$em->persist($post);
$em->persist($postPic1);
$em->flush();

$name = 'zio.jpg';
$size = 1024;
$type = 'image/jpg';
$imageData = "ziopera";

$postPic2 = new EImage($name, $size, $type, $imageData);
$post->addImage($postPic2);
$postPic2->setPost($post);

$em->persist($post);
$em->persist($postPic2);
$em->flush();