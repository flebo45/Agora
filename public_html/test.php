<?php
require_once "../bootstrap.php";
require_once "../autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

USession::getInstance();

// Test the isLogged() method

// Simulate a logged-in user
USession::setSessionElement('user', '1');
if (CUser::isLogged()) {
    echo "User is logged in.\n";
} else {
    echo "User is not logged in.\n";
}

// Simulate a user not logged in
//USession::unsetSessionElement('user');
if (CUser::isLogged()) {
    echo "User is logged in.\n";
} else {
    echo "User is not logged in.\n";
}

$userId = USession::getSessionElement('user');
echo $userId;
