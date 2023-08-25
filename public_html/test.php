<?php
require_once "../bootstrap.php";
require_once "../autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

USession::getInstance();

// Test the isLogged() method
$userRet = $pm::retriveUser(1);

// Simulate a logged-in user
USession::setSessionElement('user', $userRet);
if (CUser::isLogged()) {
    echo "User is logged in.\n";
} else {
    echo "User is not logged in.\n";
}

// Simulate a user not logged in
//USession::unsetSessionElement('user');


$user = USession::getSessionElement('user');
echo $user->getId();
