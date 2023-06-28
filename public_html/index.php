<?php

require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$newUserName = "Alessio";
$newUserSurname = "Torrieri";
$newUserAge = 21;
$newUserEmail = "alessio.torrieri@gmail.com";
$newUserUsername = "flebo45";
$newPassword ="cazzoInCuloNonfaFigli";

$user = new User($newUserName, $newUserSurname, $newUserAge, $newUserEmail, $newUserUsername, $newPassword);

$em->persist($user);

$user2 = new User("Silvia", "Mastracci", 22, "silvia.mastracci@gmail.com", "silvia.mastracci12", "Silvia123");

$em->persist($user2);

$em->flush();

$user->addFollowedUser($user2);

$em->persist($user2);

$em->flush();


$titoloPost = "Una vacanza da sogno in quel di Catanzaro";
$descrizionePost = "bla bla bla bla bla bla bla bla catanzaro esplosa";
$categoriaPost = "travelling";

$post = new Post($titoloPost, $descrizionePost, $categoriaPost);

$post->setCreator($user);
$user->addPost($post);

$em->persist($post);
$em->persist($user);

$em->flush();

$like = new ELike($user2, $post);
$em->persist($like);

$user2->addLike($like);
$post->addLike($like);


$em->persist($post);
$em->persist($user2);
$em->persist($like);
$em->flush();

$body = "GG vacanza troppo divertente";

$comment = new Comment($body, $user2, $post);
$user2->addComment($comment);
$post->addComment($comment);

$em->persist($comment);
$em->persist($post);
$em->persist($user2);

$em->flush();

$pro_pic_user = new Image("nome", "size", ".jpeg", "ddjoddoijdijodsijodijo");
$pro_pic_user->setUser($user);
$user->setProPic($pro_pic_user);
$em->persist($pro_pic_user);
$em->persist($user);

$em->flush();

$postPic = new Image("name", "size", ".jpeg", "uhsfhuidsfsefhufhu");
$postPic->setPost($post);
$post->addImage($postPic);

$em->persist($postPic);
$em->persist($post);

$em->flush();

$postReport = new Report("descrizione del report", "tipo ad esempio SPAM", $user2);
$postReport->setPost($post);
$user2->addReports($postReport);

$post->addReport($postReport);

$em->persist($post);
$em->persist($user2);
$em->persist($postReport);

$em->flush();

$commentReport = new Report("descrizione del report", "tipo ad esempio SPAM", $user);
$commentReport->setComment($comment);
$user->addReports($commentReport);

$comment->addReport($commentReport);

$em->persist($comment);
$em->persist($user);
$em->persist($commentReport);

$em->flush();

