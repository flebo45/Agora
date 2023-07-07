<?php
require_once "bootstrap.php";
require_once "autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$newUserName = "Alessio";
$newUserSurname = "Torrieri";
$newUserAge = 21;
$newUserEmail = "alessio.torrieri@gmail.com";
$newUserUsername = "flebo45";
$newPassword ="cazzoInCuloNonfaFigli";

$user = new User($newUserName, $newUserSurname, $newUserAge, $newUserEmail, $newUserUsername, $newPassword);

$pm = FPersistentManager::getInstance();

$pm->createOrUpdateUser($user);

$titoloPost = "Una vacanza da sogno in quel di Catanzaro";
$descrizionePost = "bla bla bla bla bla bla bla bla catanzaro esplosa";
$categoriaPost = "travelling";

$post = new Post($titoloPost, $descrizionePost, $categoriaPost);

$post->setCreator($user);
$user->addPost($post);

$pm->createPost($post, $user);

//delete post (work for relation post-user)
/**$user->removePost($post);
$post->removeCreator();
$pm->deletePost($post);*/

$body = "GG vacanza troppo divertente";
$comment = new Comment($body, $user, $post);
//control
$user->addComment($comment);
$post->addComment($comment);

$pm->createComment($comment, $post, $user);

//verify tìif delete post with comments and like (after control implementation)
$titoloPost2 = "Titolo Post 2";
$descrizionePost2 = "Descrizione Post 2";
$categoriaPost2 = "Categoria Post 2";

$post2 = new Post($titoloPost2, $descrizionePost2, $categoriaPost2);
$post2->setCreator($user);
$user->addPost($post2);
$pm->createPost($post2, $user);

$titoloPost3 = "Titolo Post 3";
$descrizionePost3 = "Descrizione Post 3";
$categoriaPost3 = "Categoria Post 3";

$post3 = new Post($titoloPost3, $descrizionePost3, $categoriaPost3);

$post3->setCreator($user);
$user->addpost($post3);
$pm->createPost($post3, $user);

$postOfUser = $pm->userPostList($user);

print_r($postOfUser);  //work

$newBio = "newBio";
$user->setBio($newBio);

$pm->createOrUpdateUser($user);

$bio3 = "bio3";
$user->setBio($bio3);

$pm->createOrUpdateUser($user);


/**$pro_pic_user = new Image("nome", "size", ".jpeg", "ddjoddoijdijodsijodijo");
$pro_pic_user->setUser($user);
$user->setProPic($pro_pic_user);

$pm->updateUserProPic($pro_pic_user, $user);*/