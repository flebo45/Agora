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

$pm = FPersistentManager::getInstance();
$em->persist($user);

$pm->createOrUpdateUser($user);

$titoloPost = "Una vacanza da sogno in quel di Catanzaro";
$descrizionePost = "bla bla bla bla bla bla bla bla catanzaro esplosa";
$categoriaPost = "travelling";

$post = new Post($titoloPost, $descrizionePost, $categoriaPost);
//questi 2 metodi andranno nella control
$post->setCreator($user);
$user->addPost($post);

$pm->createPost($post, $user);