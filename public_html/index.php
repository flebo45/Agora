<?php

require_once "bootstrap.php";
require_once "autoloader.php";
//require_once "StartSmarty.php"; // richiama la classe Startsmarty.php dove sono specificate le posizioni delle cartelle che servono a smarty

$em = getEntityManager();
$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

//-----------------USERS---------------------------------------------

$newUserName = "Alessio";
$newUserSurname = "Torrieri";
$newUserAge = 21;
$newUserEmail = "alessio.torrieri@gmail.com";
$newUserUsername = "flebo45";
$newPassword ="cazzoInCuloNonfaFigli";

$user = new User($newUserName, $newUserSurname, $newUserAge, $newUserEmail, $newUserUsername, $newPassword);

$pm::uploadUser($user);

$user2 = new User("Silvia", "Mastracci", 22, "silvia.mastracci@gmail.com", "silvia.mastracci12", "Silvia123");

$pm::uploadUser($user2);

$user->follow($user2);

$pm::uploadUser($user);
$pm::uploadUser($user2);

//----------------------------POST-------------------------------------------------

$titoloPost = "Una vacanza da sogno in quel di Catanzaro";
$descrizionePost = "bla bla bla bla bla bla bla bla catanzaro esplosa";
$categoriaPost = "travelling";

$post = new Post($titoloPost, $descrizionePost, $categoriaPost);

$post->setUser($user);
$user->addPost($post);

$pm::uploadPost($post, $user);

//-------------------------------COMMENTS----------------------------------------------------

$body = "GG vacanza troppo divertente";

$comment = new Comment($body, $user2, $post);
$post->addComment($comment);

$pm::createComment($comment,$post,$user2);

$comment2 = new Comment($body, $user2, $post);
$post->addComment($comment2);

$pm::createComment($comment2,$post,$user2);

$comment3 = new Comment($body, $user2, $post);
$post->addComment($comment3);

$pm::createComment($comment3,$post,$user2);

$comment4 = new Comment($body, $user2, $post);
$post->addComment($comment4);

$pm::createComment($comment4,$post,$user2);

//-------------------------------LIKE-----------------------------------------------------------

$like = new ELike($user2, $post);

$user2->addLike($like);
$post->addLike($like);

$pm::createLike($like, $post, $user2);

//------------------------------IMAGES---------------------------------------------------------

$imagePost = new Image("name","size","type","imagedata");

$imagePost->setPost($post);
$post->addImage($imagePost);

$pm::uploadImagePost($imagePost, $post);

$imageUser = new Image("name","size","type","dati");

$imageUser->setUser($user);
$user->setProfileImage($imageUser);

$pm::uploadImageUser($imageUser, $user);

//----------------------------REPORTS---------------------------------------------

$reportPOst = new Report("description", "type", $user2);

$user2->addReport($reportPOst);
$reportPOst->setPost($post);
$post->addReport($reportPOst);

$pm::uploadReportPost($reportPOst, $user2, $post);

$reportComment = new Report("description", "type", $user);

$user->addReport($reportComment);
$reportComment->setComment($comment);
$comment->addReport($reportComment);

$pm::uploadReportComment($reportComment, $user, $comment);

//TODO code ReportList(for the moderator, divided in comments report and post report), UploadMultipleFoto, followerList (e viceversa se si deve fare), UserList (per la ricerca), PostList(per la ricerca)
